<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\OrganizationRepositoryInterface;
use App\Repositories\Eloquent\OrganizationRepository;

use App\Services\Contracts\OrganizationServiceInterface;
use App\Services\OrganizationService;

use App\Services\AuthService;
use App\Services\Contracts\AuthServiceInterface;
use App\Repositories\Contracts\IdentityRepositoryInterface;
use App\Repositories\Eloquent\IdentityRepository;

use App\Repositories\Contracts\CredentialRepositoryInterface;
use App\Repositories\Eloquent\CredentialRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            IdentityRepositoryInterface::class,
            IdentityRepository::class
        );

        $this->app->bind(
    AuthServiceInterface::class,
    AuthService::class
);
        $this->app->bind(
    OrganizationRepositoryInterface::class,
    OrganizationRepository::class
);

$this->app->bind(
    OrganizationServiceInterface::class,
    OrganizationService::class
);

        $this->app->bind(
            CredentialRepositoryInterface::class,
            CredentialRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}