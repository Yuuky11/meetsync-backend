<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMeetingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'organization_id' => [
                'required',
                'uuid',
                'exists:organizations,id'
            ],

            'title' => [
                'required',
                'string',
                'max:200'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'meeting_type' => [
                'required',
                'in:ONLINE,OFFLINE,HYBRID'
            ],

            'start_at' => [
                'required',
                'date'
            ],

            'end_at' => [
                'required',
                'date',
                'after:start_at'
            ],
        ];
    }
}