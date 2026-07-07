<?php

namespace App\Services;

use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Contracts\CredentialRepositoryInterface;
use App\Repositories\Contracts\IdentityRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected IdentityRepositoryInterface $identityRepository;

    protected CredentialRepositoryInterface $credentialRepository;

    public function __construct(
        IdentityRepositoryInterface $identityRepository,
        CredentialRepositoryInterface $credentialRepository
    ) {
        $this->identityRepository = $identityRepository;
        $this->credentialRepository = $credentialRepository;
    }

    public function register(RegisterRequest $request)
{
    DB::beginTransaction();

    try {

        $identity = $this->identityRepository->create([
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'status'    => 'ACTIVE',
        ]);

        $this->credentialRepository->create([
            'identity_id'   => $identity->id,
            'provider'      => 'LOCAL',
            'password_hash' => Hash::make($request->password),
        ]);

        $token = $identity->createToken('mobile')->plainTextToken;

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'data' => [
                'identity' => $identity,
                'token'    => $token,
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
    $identity = $this->identityRepository->findByEmail($request->email);

    if (!$identity) {
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.',
        ], 401);
    }

    $credential = $this->credentialRepository->findByIdentityId($identity->id);

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
    /** @var \App\Models\Identity|null $user */
    $user = $request->user();

    /** @var PersonalAccessToken|null $token */
    $token = $user?->currentAccessToken();

    if ($token) {
        $token->delete();
    }

    return response()->json([
        'success' => true,
        'message' => 'Logout berhasil',
    ]);
}
}