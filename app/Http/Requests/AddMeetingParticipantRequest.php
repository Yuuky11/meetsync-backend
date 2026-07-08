<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMeetingParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'meeting_id' => [
                'required',
                'uuid',
                'exists:meetings,id'
            ],

            'identity_ids' => [
                'required',
                'array',
                'min:1'
            ],

            'identity_ids.*' => [
                'uuid',
                'exists:identities,id'
            ],

        ];
    }
}