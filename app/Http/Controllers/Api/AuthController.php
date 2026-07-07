<?php

namespace App\Http\Controllers\Api;

use App\Services\Contracts\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Credential;
use App\Models\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;



class AuthController extends Controller
{
    protected AuthServiceInterface $authService;
    public function __construct(AuthServiceInterface $authService)
{
    $this->authService = $authService;
}
    public function register(RegisterRequest $request)
{
    return $this->authService->register($request);
}

public function login(LoginRequest $request)
{
    return $this->authService->login($request);
}

public function profile(Request $request)
{
    return $this->authService->profile($request);
}

public function logout(Request $request)
{
    return $this->authService->logout($request);
}
}