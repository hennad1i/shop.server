<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Exception;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rules       = [
            'email'    => 'required|email',
            'password' => 'required',
        ];
        $validator   = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => $validator->messages(),
                ]
            );
        }
        try {
            // Attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    [
                        'status'  => 'error',
                        'message' => 'We can`t find an account with this credentials.',
                    ],
                    401
                );
            }
        } catch (JWTException $e) {
            // Something went wrong with JWT Auth.
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => 'Failed to login, please try again.',
                ],
                500
            );
        }
    
        // All good so return the token
        return response()->json(
            [
                'status' => 'success',
                'data'   => [
                    'token' => $token,
                    'user' => auth()->user()
                ],
            ]
        );
    }
    
    public function logout(Request $request)
    {
        // Get JWT Token from the request header key "Authorization"
        $token = $request->header('Authorization');
        // Invalidate the token
        try {
            JWTAuth::invalidate($token);
            return response()->json(
                [
                    'status'  => 'success',
                    'message' => "User successfully logged out.",
                ]
            );
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => 'Failed to logout, please try again.',
                ],
                500
            );
        }
    }
    
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        
        try{
            $user->save();
            $result = $this->login($request);
        } catch (Exception $exception) {
            $result = false;
        }
        
        return $result ? $result : response()->json(
            [
                'status'  => 'error',
                'message' => 'Email exists already',
            ],
            409
        );
    }
}
