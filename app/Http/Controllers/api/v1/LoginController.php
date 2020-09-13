<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'),]);
        //was any of those correct ?
        if (Auth::check()) {
            //send them where they are going
            $user = Auth::user();
            if ($user->active) {
                $token = $user->createToken('AccessToken')->accessToken;
                return response()->json([
                    'success' => 'Login Successful',
                    'token' => $token,
                    'user' => new UserResource($user)
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Account Suspended'
                ]);
            }
        }
        return response()->json([
            'error' => 'Invalid email or password'
        ]);
    }
}
