<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,

            'description' => $this->description,

            'meeting_type' => $this->meeting_type,

            'status' => $this->status,

            'start_at' => $this->start_at,

            'end_at' => $this->end_at,

            'organization_id' => $this->organization_id,

            'created_by' => $this->created_by,

            'created_at' => $this->created_at,
        ];
    }
}