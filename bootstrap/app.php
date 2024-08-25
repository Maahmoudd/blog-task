<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $exception) {
            // Handle ModelNotFoundException
            if ($exception instanceof NotFoundHttpException) {
                return response()->json(
                    ['message' => 'Resource not found.'],
                    Response::HTTP_NOT_FOUND
                );
            }

            // Handle AuthorizationException
            if ($exception instanceof AccessDeniedHttpException) {
                return response()->json(
                    ['message' => 'This action is unauthorized.'],
                    Response::HTTP_UNAUTHORIZED
                );
            }
            return response()->json(
                ['message' => $exception->getMessage()],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        });
    })->create();
