<?php

namespace App\Repositories\Eloquent;

use App\Models\Meeting;
use App\Repositories\Contracts\MeetingRepositoryInterface;

class MeetingRepository implements MeetingRepositoryInterface
{
    public function create(array $data): Meeting
    {
        return Meeting::create($data);
    }

    public function findById(string $id): ?Meeting
    {
        return Meeting::query()->find($id);
    }

    public function getByOrganization(string $organizationId)
    {
        return Meeting::query()
            ->where('organization_id', $organizationId)
            ->get();
    }
}