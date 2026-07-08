<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrganizationRequest;
use App\Services\Contracts\OrganizationServiceInterface;

class OrganizationController extends Controller
{
    public function __construct(
        protected OrganizationServiceInterface $organizationService
    ) {
    }

    public function store(CreateOrganizationRequest $request)
    {
        return $this->organizationService->create($request);
    }

    public function index()
{
    return $this->organizationService->index();
}
}