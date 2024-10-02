<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}


    public function login(LoginRequest $request)
    {
        $token = $this->authService->login($request);

        return response()->json([
            'message' => 'sesión iniciada correctamente',
            'token' => $token
        ]);
    }

    public function register(RegisterRequest $request) 
    {
        $this->authService->register($request);

        return response()->json([
            'message' => 'usuario registrado correctamente'
        ], 201);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return response()->noContent();
    }
}
