<?php

namespace App\Repositories\Eloquent;

use App\Models\Identity;
use App\Repositories\Contracts\IdentityRepositoryInterface;

class IdentityRepository implements IdentityRepositoryInterface
{
    public function create(array $data): Identity
    {
        return Identity::create($data);
    }

    public function findByEmail(string $email): ?Identity
    {
        return Identity::query()
            ->firstWhere('email', $email);
    }

    public function findById(string $id): ?Identity
    {
        return Identity::query()
            ->find($id);
    }
}