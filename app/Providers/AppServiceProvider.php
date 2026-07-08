<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\OrganizationRepositoryInterface;
use App\Repositories\Eloquent\OrganizationRepository;

use App\Repositories\Contracts\OrganizationMemberRepositoryInterface;
use App\Repositories\Eloquent\OrganizationMemberRepository;

use App\Services\Contracts\OrganizationServiceInterface;
use App\Services\OrganizationService;


use App\Services\Contracts\MeetingServiceInterface;
use App\Services\MeetingService;

use App\Repositories\Contracts\MeetingParticipantRepositoryInterface;
use App\Repositories\Eloquent\MeetingParticipantRepository;

use App\Repositories\Contracts\MeetingRepositoryInterface;
use App\Repositories\Eloquent\MeetingRepository;

use App\Repositories\Contracts\AttendanceRepositoryInterface;
use App\Repositories\Eloquent\AttendanceRepository;

use App\Services\Contracts\AttendanceServiceInterface;
use App\Services\AttendanceService;

use App\Repositories\Contracts\MeetingQrTokenRepositoryInterface;
use App\Repositories\Eloquent\MeetingQrTokenRepository;

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
    AttendanceServiceInterface::class,
    AttendanceService::class
);

        $this->app->bind(
    MeetingQrTokenRepositoryInterface::class,
    MeetingQrTokenRepository::class
);

        $this->app->bind(
    MeetingParticipantRepositoryInterface::class,
    MeetingParticipantRepository::class
);
        $this->app->bind(
    AttendanceRepositoryInterface::class,
    AttendanceRepository::class
);

        $this->app->bind(
    MeetingServiceInterface::class,
    MeetingService::class
);

        $this->app->bind(
    MeetingRepositoryInterface::class,
    MeetingRepository::class
);

        $this->app->bind(
    OrganizationMemberRepositoryInterface::class,
    OrganizationMemberRepository::class
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