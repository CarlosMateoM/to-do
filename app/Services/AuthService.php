<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService 
{
    
    public function login(LoginRequest $request) 
    {
        $user = User::where('email', $request->input('email'))
            ->firstOrFail();

        $credentials = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ];

        if(Auth::attempt($credentials)) {
            
            return $user->createToken();
        }
 

        return response()->json([
            'message' => 'el correo o la contraseña no coinciden'
        ], 422);
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