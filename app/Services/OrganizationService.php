<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateOrganizationRequest;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use App\Services\Contracts\OrganizationServiceInterface;

class OrganizationService implements OrganizationServiceInterface
{
    public function __construct(
        protected OrganizationRepositoryInterface $organizationRepository
    ) {
    }

    public function create(CreateOrganizationRequest $request)
    {
        $organization = $this->organizationRepository->create([
            'owner_identity_id' => Auth::id(),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'logo_url' => $request->logo_url,
            'status' => 'ACTIVE',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Organization berhasil dibuat',
            'data' => $organization,
        ], 201);
    }
}