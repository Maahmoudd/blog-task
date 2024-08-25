<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Services\IAuthService;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends ApiBaseController
{
    public function __construct(protected IAuthService $authService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $authUser = $this->authService->register($request);
        return $authUser ? $this->respondCreated($authUser) : $this->respondError(errors: 'Failed To Register', status: Response::HTTP_BAD_REQUEST);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $authUser = $this->authService->login($request);
        return $authUser ? $this->respondSuccess($authUser) : $this->respondError(errors: 'Unauthorized', status: Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
