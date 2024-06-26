<?php

namespace App\Providers;

use App\Interfaces\AuthenticationInterface;
use App\Interfaces\EventInterface;
use App\Repositories\AuthenticationRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationInterface::class, AuthenticationRepository::class);
        $this->app->bind(EventInterface::class, EventRepository::class);
    }
}
