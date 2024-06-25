<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // bindings-placeholder
        $this->app->bind('App\Interfaces\RoleAsignmentsInterface', 'App\Repositories\RoleAsignmentsRepository');    }
}
