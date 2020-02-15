<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Utilities\ProxyRequest;
use Illuminate\Support\Facades\Auth;


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

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        $resp = $this->proxy->grantPasswordToken(
            $user->email,
            request('password')
        );

        return response([
            'token' => $resp->access_token,
            'expiresIn' => $resp->expires_in,
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
        ], 200);
    }

}
