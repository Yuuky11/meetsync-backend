<?php

namespace App\Services\Contracts;

use App\Http\Requests\CreateOrganizationRequest;
use App\Http\Requests\AddOrganizationMemberRequest;

interface OrganizationServiceInterface
{
    public function create(CreateOrganizationRequest $request);

    public function index();

    public function addMembers(AddOrganizationMemberRequest $request);
}