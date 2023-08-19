<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(){

    }

    public function login(Request $request){
    
        if(!Auth::attempt($request->only('email','password'))){
     
            return response()->json("Usuario não autorizado",401);
        }

        $user = Auth::user();
        $token = $user->createToken('token_auth');

        return response()->json($token->plainTextToken,200);
    }


    public function edit(){

    }
    public function destroy(){

    }
}
