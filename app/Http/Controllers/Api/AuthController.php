<?php

namespace App\Http\Controllers\Api;

use App\Models\Identity;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {

            $identity = Identity::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => 'ACTIVE',
            ]);

            Credential::create([
                'identity_id' => $identity->id,
                'provider' => 'LOCAL',
                'password_hash' => Hash::make($request->password),
            ]);

            $token = $identity->createToken('mobile')->plainTextToken;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Register berhasil',
                'data' => [
                    'identity' => $identity,
                    'token' => $token,
                ]
            ], 201);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        $identity = Identity::where('email', $request->email)->first();

        if (!$identity) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.',
            ], 401);
        }

        $credential = Credential::where('identity_id', $identity->id)->first();

        if (!$credential || !Hash::check($request->password, $credential->password_hash)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.',
            ], 401);
        }

        $token = $identity->createToken('mobile')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'identity' => $identity,
                'token' => $token,
            ]
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }
}