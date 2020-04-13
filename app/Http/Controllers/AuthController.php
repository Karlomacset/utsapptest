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

        $user = User::where('email',request('email'))->first();
        $userDB = User::where('userDB',request('userDB'))->first();

        if(substr(request('userDB'),3,3) != 'doc'){
            // use this if not doctor
            $dispatchDB = request('userDB');
            $docRoles = ['mdpMembers'];
        }else {
            $dispatchDB = '';
            $docRoles = ['mdpMembers','mdpDoctors'];
        }

        if(!$user && !$userDB){
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'userDB'=> request('userDB'),
                'dispatchDB'=> $dispatchDB,
                'psc_token'=> bcrypt(request('pscode')),
            ]);
    
            $resp = $this->proxy->grantPasswordToken(
                $user->email,
                request('password')
            );

            activity('registration')
                ->log('genCDB: userDB='.$user->userDB);

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
            //activity('createAccount')->log('createDB: '.$user->userDB);

            $sec = Curl::to($s)
                        ->withHeaders([
                            'Content-Type'=>'application/json',
                            'Authorization'=>'Basic YWRtaW46UmVkUml2ZXI3Nz8=',
                        ])
                        ->withData([
                            'admins'=>[
                                'names'=>['karlomac'],
                                'roles'=>['mdpDBAdmin']
                            ],
                            'members'=>[
                                'names'=>[$user->userDB],
                                'roles'=>['mdpDoctors']
                            ]
                        ])
                        ->asJson()
                        ->put();
        //    activity('createAccount')->log('assignSecurity: '.$sec);

            $usr = Curl::to($d)
                        ->withHeaders([
                            'Accept'=>'application/json',
                            'Content-Type'=>'application/json',
                            'Authorization'=>'Basic YWRtaW46UmVkUml2ZXI3Nz8=',
                        ])
                        ->withData([
                            'name'=>$user->userDB,
                            'roles'=> $docRoles,
                            'type'=>'user',
                            'password'=>'Salt1023'
                        ])
                        ->asJson()
                        ->put();
        //    activity('createAccount')->log('createUser: '.$user->userDB.' --> '.$usr);

            //$res = $this->genCDB('phl09393kmac');
    
            return response([
                'token' => $resp->access_token,
                'expiresIn' => $resp->expires_in,
                'api_id' => encrypt(request('password')),
                'message' => 'Your account has been created',
            ], 201);
        }else{
            return response([
                'token' => null,
                'expiresIn' => null,
                'error'=>true,
                'message' => 'The account already exists!',
            ], 400);
        }

        
    }

    public function buildIndexes(){
        

        $res = Curl::to('http://localhost:5984/medipad101/_design/PatientReqStub')
        ->withHeaders([
            'Content-Type:application/json',
            'Authorization:Basic YWRtaW46UmVkUml2ZXI3Nz8='
        ])
        ->withData([
            // '_id'=>'_design/PatientReqStub',
            'filters' => "{
                'Doctor' : function(doc, req){
                    return doc.doctorID === req.query.doctorID
                }.toString()
            }"
        ])
        ->asJson()
        ->put();

        activity('buildIndexes')
            ->withProperties($res)
            ->log('Build indexes ');

        return response([
            'res'=>$res,
            'message'=>'Build Index Processed',
        ]);

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
                        'roles'=>['itmsDBAdmin']
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

        if($user){
            if(\Hash::check(request('password'),$user->password)){
               //correct
                $resp = $this->proxy
                        ->grantPasswordToken(request('email'), request('password'));
                return response([
                    'token' => $resp->access_token,
                    'expiresIn' => $resp->expires_in,
                    'message' => 'You have been logged in',
                    'userID' => $user->id,
                    'userDB' => $user->userDB,
                ], 200);
           }
        }
        return response([
            'token' => '',
            'expiresIn' => '',
            'message' => 'The access combination is not valid',
        ], 403);
        
        
        
        // abort_unless($user, 404, 'This combination does not exists.');
        // abort_unless(
        //     \Hash::check(request('password'), $user->password),
        //     403,
        //     'This combination does not exists.'
        // );
    }

    public function loginPSC()
    {
        //this method uses the psc to authenticate
        $user = User::where('userDB', request('userDB'))->first();

        if($user){
            if(\Hash::check(request('pscode'),$user->psc_token)){
               //correct
                $resp = $this->proxy
                        ->grantPasswordToken(request('email'), decrypt(request('api_id')));
                return response([
                    'token' => $resp->access_token,
                    'expiresIn' => $resp->expires_in,
                    'message' => 'You have been logged in',
                    'userID' => $user->id,
                    'userDB' => $user->userDB,
                ], 200);
           }
        }
        return response([
            'token' => '',
            'expiresIn' => '',
            'message' => 'The access combination is not valid',
        ], 403);        
    }

    public function refreshToken()
    {
        $resp = $this->proxy->refreshAccessToken();
        $user = Auth::guard('api')->user();

        return response([
            'token' => $resp->access_token,
            'expiresIn' => $resp->expires_in,
            'message' => 'Token has been refreshed.',
         //   'userID' => $user->id,
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
            'userDB'=> $user->userDB,
            'dispatchDB'=> $user->dispatchDB,
        ], 200);
    }

    public function checkuserDB()
    {
        // get the user using email and return with basic data
        $user = User::where('userDB',request('userDB'))->first();
       
        //abort_unless($user, 200, 'This user does not exist.');
        if(!$user){
            return response([
                'message'=>'this userDB does not exist',
                'ok'=>false
            ], 200);
        }

        return response([
            'ok'=> true,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'userDB'=> $user->userDB,
            'dispatchDB'=> $user->dispatchDB,
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
