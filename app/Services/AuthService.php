<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService 
{
    
    public function login(LoginRequest $request) 
    {
        $user = User::where('email', $request->input('email'))->first();

        if(!$user) {
            throw ValidationException::withMessages([
                'email' => 'El usuario no existe'
            ]);
        }

        $credentials = $request->only('email', 'password');
        
        if(!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'El email o la contraseña son incorrectos'
            ]);
        }
        
        return $user->createToken('auth')->plainTextToken;
    }

    public function register(RegisterRequest $request): User
    {
        $user = new User();

        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->password     = $request->input('password');

        $user->save();

        return $user;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}