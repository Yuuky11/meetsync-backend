<?php

namespace App\Repositories\Contracts;

use App\Models\Meeting;

interface MeetingRepositoryInterface
{
    public function create(array $data): Meeting;

    public function findById(string $id): ?Meeting;

    public function getByOrganization(string $organizationId);

    public function updateStatus(string $id, string $status);

    public function findPublishedById(string $id): ?Meeting;
}