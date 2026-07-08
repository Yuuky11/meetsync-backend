<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateOrganizationRequest;
use App\Repositories\Contracts\OrganizationRepositoryInterface;
use App\Services\Contracts\OrganizationServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\OrganizationMemberRepositoryInterface;
use App\Http\Requests\AddOrganizationMemberRequest;



class OrganizationService implements OrganizationServiceInterface
{
    public function __construct(
    protected OrganizationRepositoryInterface $organizationRepository,
    protected OrganizationMemberRepositoryInterface $organizationMemberRepository
) {
}

    public function create(CreateOrganizationRequest $request)
{
    DB::beginTransaction();

    try {

        $organization = $this->organizationRepository->create([

            'owner_identity_id' => Auth::id(),

            'name' => $request->name,

            'slug' => Str::slug($request->name),

            'description' => $request->description,

            'logo_url' => $request->logo_url,

            'status' => 'ACTIVE',

        ]);

        $this->organizationMemberRepository->create([

            'organization_id' => $organization->id,

            'identity_id' => Auth::id(),

            'role' => 'OWNER',

        ]);

        DB::commit();

        return response()->json([

            'success' => true,

            'message' => 'Organization berhasil dibuat',

            'data' => $organization,

        ], 201);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([

            'success' => false,

            'message' => $e->getMessage(),

        ], 500);
    }
}
            public function index()
{
    $organizations = $this->organizationRepository
        ->getByIdentity(Auth::id());

    return response()->json([
        'success' => true,
        'data' => $organizations,
    ]);
}

        public function addMembers(AddOrganizationMemberRequest $request)
{
    DB::beginTransaction();

    try {

        $added = [];

        foreach ($request->identity_ids as $identityId) {

            if ($this->organizationMemberRepository->exists(
                $request->organization_id,
                $identityId
            )) {
                continue;
            }

            $member = $this->organizationMemberRepository->create([

                'organization_id' => $request->organization_id,

                'identity_id' => $identityId,

                'role' => 'MEMBER',

            ]);

            $added[] = $member;
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Member berhasil ditambahkan.',
            'data' => $added,
        ]);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);

    }
}
}