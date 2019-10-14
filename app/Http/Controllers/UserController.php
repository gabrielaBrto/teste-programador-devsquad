<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;

class UserController extends Controller
{
    public function login(Request $request){
		$dados = $request->only('email','password');
		if(Auth::attempt($dados)){
			Auth::user()->remember_token = Hash::make('remember_token');
			Auth::user()->api_token = Hash::make('api_token');
			Auth::user()->save();
			return json_encode([
				"nome" => Auth::user()->nome,		
				"id" => Auth::id(),
				"token" => Auth::user()->remember_token,
				"api_token" => Auth::user()->api_token,
			]);
		}else
			return json_encode(false);
    }
    
    public function verifica(Request $request){
		$data = $request->only('api_token');
		$user = User::where('api_token','=',$data)->first();
		return json_encode($user);

	}


}
