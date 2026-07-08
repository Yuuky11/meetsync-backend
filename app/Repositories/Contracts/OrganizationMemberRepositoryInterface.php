<?php

namespace App\Repositories\Contracts;

use App\Models\OrganizationMember;

interface OrganizationMemberRepositoryInterface
{
    public function create(array $data): OrganizationMember;
}