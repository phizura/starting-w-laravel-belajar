<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Interfaces\CobaRepositoryInterface', 'App\Repositories\CobaRepositoryRepository');
        // bindings-placeholder
        $this->app->bind('App\Interfaces\RoleAsignmentsInterface', 'App\Repositories\RoleAsignmentsRepository');
    }
}
