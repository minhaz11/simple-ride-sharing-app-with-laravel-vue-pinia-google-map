<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginNeedsVerification;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(Request $request){

        $request->validate([
            'phone'=>'required|numeric|min:10',
        ]);

        $loginCode = rand(111111, 999999);
        
        $user = User::firstOrCreate([
            'phone'=>$request->phone,
            'login_code' => $loginCode
        ]);

        if(!$user){
            return response()->json([
                'message'=>'User not found',
            ],404);
        }

     //   $user->notify(new LoginNeedsVerification());

        return response()->json([
            'message'=>'Verification code sent',
        ],200);
    }


    function verify(Request $request){

        $request->validate([
            'phone'=>'required|numeric|min:10',
            'login_code'=>'required|numeric|min:6|between:111111,999999',
        ]);

        $user = User::where([
            'phone'=>$request->phone,
            'login_code'=>$request->login_code,
        ])->first();

        if($user){

            $user->update([
                'login_code'=>null,
            ]);

            return $user->createToken($request->login_code)->plainTextToken;
        }

        

        return response()->json([
            'message'=>'Invalid login code',
        ],401);
        
    }
}
