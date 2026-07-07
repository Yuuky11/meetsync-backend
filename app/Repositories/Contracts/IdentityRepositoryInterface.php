<?php

namespace App\Repositories\Contracts;

use App\Models\Identity;

interface IdentityRepositoryInterface
{
    public function create(array $data): Identity;

    public function findByEmail(string $email): ?Identity;

    public function findById(string $id): ?Identity;
}
