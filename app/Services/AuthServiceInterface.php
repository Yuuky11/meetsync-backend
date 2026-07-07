<?php

namespace App\Services\Contracts;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function register(RegisterRequest $request);

    public function login(LoginRequest $request);

    public function profile(Request $request);

    public function logout(Request $request);
}