<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request){
        //validation
        $credentials=$request->validate([
            "email"=>["required","string"],
            "password"=>["required","string"]
        ]);
        //Auth::attempt verifie si le user existe 
        if(Auth::attempt($credentials))
        {
            //le user existe dans la base de données
        	//on genere le token
            // $user=Auth()->user();
            $token = $request->user()->createToken('My Token', ['place-orders'])->plainTextToken;
            // $token=$request->user()->createToken("login_token");
            
            return [
                "data"=>[

                    "token"=>$token,
                    "user"=>$request->user()
                ]
            ];
        }
        //le user n'existe pas
        return response(["message"=>"Identifiant non correct"],Response::HTTP_NOT_ACCEPTABLE);
    }
    public function logout(Request $request){
        $request->user()->token()->revoke();
    }
    public function get(Request $request){
        return $request->user();
    }
}
