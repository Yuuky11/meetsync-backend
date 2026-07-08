<?php

namespace App\Services\Contracts;

use App\Http\Requests\CreateOrganizationRequest;

interface OrganizationServiceInterface
{
    public function create(CreateOrganizationRequest $request);

    public function index();
}