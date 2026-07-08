<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOrganizationMemberRequest extends FormRequest
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