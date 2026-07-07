<?php

namespace App\Repositories\Eloquent;

use App\Models\Credential;
use App\Repositories\Contracts\CredentialRepositoryInterface;

class CredentialRepository implements CredentialRepositoryInterface
{
    public function create(array $data): Credential
    {
        return Credential::create($data);
    }

    public function findByIdentityId(string $identityId): ?Credential
    {
        return Credential::query()
            ->firstWhere('identity_id', $identityId);
    }
}