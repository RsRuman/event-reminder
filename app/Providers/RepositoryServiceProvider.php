<?php

namespace App\Providers;

use App\Http\Repositories\AuthenticationRepository;
use App\Interfaces\AuthenticationInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationInterface::class, AuthenticationRepository::class);
    }
}
