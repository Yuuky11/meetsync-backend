<?php

namespace App\Repositories\Eloquent;

use App\Models\Organization;
use App\Repositories\Contracts\OrganizationRepositoryInterface;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    public function create(array $data): Organization
    {
        return Organization::create($data);
    }

    public function findById(string $id): ?Organization
{
    return Organization::query()->find($id);
}

    public function findBySlug(string $slug): ?Organization
    {
        return Organization::query()
            ->firstWhere('slug', $slug);
    }
}