<?php

namespace App\Providers;

use App\Interfaces\AuthenticationInterface;
use App\Interfaces\EventInterface;
use App\Interfaces\HomeInterface;
use App\Interfaces\ImportInterface;
use App\Repositories\AuthenticationRepository;
use App\Repositories\EventRepository;
use App\Repositories\HomeRepository;
use App\Repositories\ImportRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(HomeInterface::class, HomeRepository::class);
        $this->app->bind(AuthenticationInterface::class, AuthenticationRepository::class);
        $this->app->bind(EventInterface::class, EventRepository::class);
        $this->app->bind(ImportInterface::class, ImportRepository::class);
    }
}
