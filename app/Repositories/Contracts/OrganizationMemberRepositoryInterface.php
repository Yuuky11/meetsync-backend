<?php

namespace App\Repositories\Contracts;

use App\Models\OrganizationMember;

interface OrganizationMemberRepositoryInterface
{
    public function create(array $data): OrganizationMember;

    public function findMember(string $organizationId, string $identityId);

    public function findByIdentity(string $organizationId, string $identityId);

    public function exists(string $organizationId, string $identityId): bool;
}