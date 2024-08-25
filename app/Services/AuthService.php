<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{

    public function register(RegisterRequest $request): array
    {
        $user = User::create($request->validated());
        return ['user' => UserResource::make($user)];
    }

    /**
     * @param LoginRequest $request
     * @return array
     */
    public function login(LoginRequest $request): array | null
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('ApiToken')->plainTextToken;
            return ['user' => UserResource::make($user), 'token' => $token, 'type' => 'Bearer'];
        }
        return null;
    }
}
