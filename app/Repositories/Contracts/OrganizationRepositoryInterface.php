<?php

namespace App\Repositories\Contracts;

use App\Models\Organization;

interface OrganizationRepositoryInterface
{
    public function create(array $data): Organization;

    public function findById(string $id): ?Organization;

    public function findBySlug(string $slug): ?Organization;
}