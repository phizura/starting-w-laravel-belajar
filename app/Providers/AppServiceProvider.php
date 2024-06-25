<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Interfaces\User\UserInterface;
use App\Interfaces\Category\CategoryInterface;
use App\Interfaces\PostInterface;
use App\Interfaces\RoleAsignmentsInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\RoleAsignmentsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostInterface::class, PostRepository::class);
        $this->app->bind(RoleAsignmentsInterface::class, RoleAsignmentsRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Gate::define('admin', fn (User $user) => $user->is_admin);
    }
}
