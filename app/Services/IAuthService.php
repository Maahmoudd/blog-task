<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

interface IAuthService
{
    public function register(RegisterRequest $request): array;

    public function login(LoginRequest $request): array | null;
}
