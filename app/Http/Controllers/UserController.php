<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        try {           
            User::create($request->all())->save();
            return response()->json([
                'success'=>true,
                'message' => 'Registro inserido com sucesso'
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'success'=>false,
                'message' => 'O registro não pode ser inserido'
            ],400);
        }
    }

    public function login(Request $request){
    
        if(!Auth::attempt($request->only('email','password'))){
     
            return response()->json("Usuario não autorizado",401);
        }

        $user = Auth::user();
        $token = $user->createToken('token_auth');

        return response()->json($token->plainTextToken,200);
    }


    public function editProfile(Request $request){

    }
    public function destroyAccount(){

    }
}
