<?php

namespace App\Repositories\Eloquent;

use App\Models\OrganizationMember;
use App\Repositories\Contracts\OrganizationMemberRepositoryInterface;

class OrganizationMemberRepository implements OrganizationMemberRepositoryInterface
{
    public function create(array $data): OrganizationMember
    {
        return OrganizationMember::create($data);
    }

    public function findMember(string $organizationId, string $identityId)
{
    return OrganizationMember::query()
        ->where('organization_id', $organizationId)
        ->where('identity_id', $identityId)
        ->first();
}
                public function findByIdentity(string $organizationId, string $identityId)
{
    return OrganizationMember::query()
        ->where('organization_id', $organizationId)
        ->where('identity_id', $identityId)
        ->first();
}

            public function exists(string $organizationId, string $identityId): bool
{
    return OrganizationMember::query()
        ->where('organization_id', $organizationId)
        ->where('identity_id', $identityId)
        ->exists();
}
}