<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{   
    public function index(){
        $user = Auth::user();
        return response()->json($user,200);
    }
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
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
     
            return response()->json("Usuario não encontrado",401);
        }

        $user = Auth::user();
        $token = $user->createToken('token_auth');

        return response()->json($token->plainTextToken,200);
    }  

    public function updateProfile(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|',
            'password' => 'required|min:8',
        ]);

        try {
            $user = Auth::user();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
    
            $user->save();
    
            return response()->json("Dados atualizados com sucesso !", 200);   
        } catch (\Throwable $th) {
            return response()->json("Dados não foram atualizados confirme suas informações", 400); 
        }
    }
    public function destroyAccount(){
        $user = Auth::user();
        $user->delete();

        return response()->json("Conta excluida com sucesso !",200);
    }
}
