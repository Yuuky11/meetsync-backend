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
}