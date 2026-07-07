<?php

namespace App\Repositories\Contracts;

use App\Models\Credential;

interface CredentialRepositoryInterface
{
    public function create(array $data): Credential;

    public function findByIdentityId(string $identityId): ?Credential;
}