<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = app(AuthService::class);
    }

    public function test_it_registers_a_new_user()
    {
        $request = Mockery::mock(RegisterRequest::class);
        $request->shouldReceive('validated')->andReturn([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        // Mock UserResource
        $userResourceMock = Mockery::mock(UserResource::class);
        $userResourceMock->shouldReceive('make')->andReturn($userResourceMock);
        $userResourceMock->name = 'John Doe';
        $userResourceMock->email = 'john@example.com';

        $user = Mockery::mock(User::class);
        $user->shouldReceive('create')->andReturn($user);
        $user->shouldReceive('toArray')->andReturn([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Bind the mocked UserResource to the container
        $this->app->instance(UserResource::class, $userResourceMock);

        $result = $this->authService->register($request);

        $this->assertArrayHasKey('user', $result);
        $this->assertEquals('John Doe', $result['user']->name);
        $this->assertEquals('john@example.com', $result['user']->email);
    }

    public function test_it_logs_in_a_user_and_returns_token()
    {
        $user = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);

        $request = Mockery::mock(LoginRequest::class);
        $request->shouldReceive('validated')->andReturn([
            'email' => 'jane@example.com',
            'password' => 'password',
        ]);

        Auth::shouldReceive('attempt')
            ->with([
                'email' => 'jane@example.com',
                'password' => 'password'
            ])
            ->andReturn(true);

        Auth::shouldReceive('user')
            ->andReturn($user);


        $result = $this->authService->login($request);

        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('token', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertEquals('Bearer', $result['type']);
        $this->assertEquals('jane@example.com', $result['user']->email);
    }

    public function test_it_returns_null_when_login_fails()
    {
        $request = Mockery::mock(LoginRequest::class);
        $request->shouldReceive('validated')->andReturn([
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        Auth::shouldReceive('attempt')
            ->with([
                'email' => 'nonexistent@example.com',
                'password' => 'wrongpassword'
            ])
            ->andReturn(false);

        $result = $this->authService->login($request);

        $this->assertNull($result);
    }
}
