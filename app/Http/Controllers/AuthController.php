<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    )
    {}


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
        $user = $this->authService->register($request);

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return response()->noContent();
    }
}
