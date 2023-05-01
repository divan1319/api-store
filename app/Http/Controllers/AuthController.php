<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        $data = $registerRequest->validated();
        
        //REGISTRANDO AL USUARIO
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'username'=>Str::of($data['username'])->slug('-'),
            'rol'=>$data['rol']
        ]);

        //retornando respuesta

        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];


    }

    public function login(LoginRequest $loginRequest)
    {
        $data = $loginRequest->validated();     
        //revisando el password
        if(!auth()->attempt(['username'=>$data['username'],'password'=>$data['password']])){
            return response([
                'errors' => ['El email o password no coinciden']
            ],422);
        }
        //Autentincando al usuario
        $user = auth()->user();
        
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];

    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        
    }
}
