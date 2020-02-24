<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Utilities\ProxyRequest;
use Illuminate\Support\Facades\Auth;
use App\Product;
use Ixudra\Curl\Facades\Curl;

class AuthController extends Controller
{
    protected $proxy;

    public function __construct(ProxyRequest $proxy)
    {   
        $this->proxy = $proxy;
    }

    public function register()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email',request('email'))->get();

        if(true){
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'userDB'=> request('userDB'),
            ]);
    
            $resp = $this->proxy->grantPasswordToken(
                $user->email,
                request('password')
            );
            activity('test')->log('genCDB: userDB='.request('userDB'));
            activity('test2')->log('genCDB: userDB='.$user->userDB);

            $r = 'http://localhost:5984/'.$user->userDB;
            $s = $r.'/_security';
            $d = 'http://localhost:5984/_users/org.couchdb.user:'.$user->userDB;

            // send command to create the userDB in cdb
            $res = Curl::to($r)
                        ->withHeaders([
                            'Content-Type'=>'application/json',
                            'Authorization'=>'Basic YWRtaW46UmVkUml2ZXI3Nz8='
                        ])
                        ->put();
            $sec = Curl::to($s)
                        ->withHeaders([
                            'Content-Type'=>'application/json',
                            'Authorization'=>'Basic YWRtaW46UmVkUml2ZXI3Nz8=',
                        ])
                        ->withData([
                            'admins'=>[
                                'names'=>['karlomac'],
                                'roles'=>['phlDBAdmin']
                            ],
                            'members'=>[
                                'names'=>[$user->userDB],
                            ]
                        ])
                        ->asJson()
                        ->put();

            $usr = Curl::to($d)
                        ->withHeaders([
                            'Accept'=>'application/json',
                            'Content-Type'=>'application/json',
                            'Authorization'=>'Basic YWRtaW46UmVkUml2ZXI3Nz8=',
                        ])
                        ->withData([
                            'name'=>$user->userDB,
                            'roles'=>['phlMembers'],
                            'type'=>'user',
                            'password'=>'Salt1023'
                        ])
                        ->asJson()
                        ->put();

            //$res = $this->genCDB('phl09393kmac');
    
            return response([
                'token' => $resp->access_token,
                'expiresIn' => $resp->expires_in,
                'userDB' => [$res,$sec,$usr],
                'message' => 'Your account has been created',
            ], 201);
        }else{
            return response([
                'token' => null,
                'expiresIn' => null,
                'message' => 'The account already exists!',
            ], 400);
        }

        
    }

    public function genCDB($id)
    {
        activity('test')->log('genCDB: userDB='.$id);

        $res = Curl::to('http://localhost:5984/'.$id)
                ->withHeaders([
                    'Content-Type:application/json',
                    'Authorization:Basic YWRtaW46UmVkUml2ZXI3Nz8='
                ])
                ->put();
        $sec = Curl::to('http://localhost:5984/'.$id.'/_security')
                ->withHeaders([
                    'Content-Type'=>'application/json',
                    'Authorization'=>'Basic YWRtaW46UmVkUml2ZXI3Nz8=',
                ])
                ->withData([
                    'admins'=>[
                        'names'=>['karlomac'],
                        'roles'=>['phlDBAdmin']
                    ],
                    'members'=>[
                        'names'=>[$id],
                    ]
                ])
                ->asJson()
                ->put();

        return response([
            'secDB' => $sec,
            'userDB' => $res,
            'message' => 'Your account has been created',
        ], 201);
    }

    public function login()
    {
        $user = User::where('email', request('email'))->first();

        abort_unless($user, 404, 'This combination does not exists.');
        abort_unless(
            \Hash::check(request('password'), $user->password),
            403,
            'This combination does not exists.'
        );

        $resp = $this->proxy
            ->grantPasswordToken(request('email'), request('password'));

        return response([
            'token' => $resp->access_token,
            'expiresIn' => $resp->expires_in,
            'message' => 'You have been logged in',
            'userID' => $user->id,
        ], 200);
    }

    public function refreshToken()
    {
        $resp = $this->proxy->refreshAccessToken();
        $user = Auth::guard('api')->user();

        return response([
            'token' => $resp->access_token,
            'expiresIn' => $resp->expires_in,
            'message' => 'Token has been refreshed.',
            'userID' => $user->id,
        ], 200);
    }

    public function logout()
    {
        $token = request()->user()->token();
        $token->delete();

        // remove the httponly cookie
        cookie()->queue(cookie()->forget('refresh_token'));

        return response([
            'message' => 'You have been successfully logged out',
        ], 200);
    }

    public function user()
    {
        // get the current user and return with basic data
        $user = Auth::guard('api')->user();
        abort_unless($user, 404, 'This user does not exist.');

        return response([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'userDB'=> $user->userDB,
        ], 200);
    }

    public function checkemail()
    {
        // get the user using email and return with basic data
        $user = User::where('email',request('email'))->first();
       
        //abort_unless($user, 200, 'This user does not exist.');
        if(blank($user)){
            return response([
                'message'=>'this user does not exist',
                'ok'=>false
            ], 200);
        }

        return response([
            'ok'=> true,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ], 200);
    }

    public function products()
    {
        //this will get all products
        $products = Product::all();
        $i = 0;
        $arr = array();
        foreach($products as $prod)
        {
            $arr[$i] = [
                'title' => $prod->title,
                'description'=> $prod->description,
                'premium'=> $prod->premium_amt,
                'mediaUrl'=> env('APP_URL').$prod->getFirstMediaUrl('products')
            ];
                
            $i = $i + 1;
        }
        return response([
            'data' => $arr,
            'message'=>'Product list was returned completely'
        ], 200);
    }

}
