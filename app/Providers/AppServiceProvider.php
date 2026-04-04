<?php

namespace App\Providers;

use App\Models\Application;
use App\Observers\ApplicationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Repository bindings
        $this->app->bind(
            \App\Repositories\JobRepository::class,
            \App\Repositories\JobRepository::class
        );

        $this->app->bind(
            \App\Repositories\EmployerRepository::class,
            \App\Repositories\EmployerRepository::class
        );

        $this->app->bind(
            \App\Repositories\ApplicationRepository::class,
            \App\Repositories\ApplicationRepository::class
        );

        $this->app->bind(
            \App\Repositories\TagRepository::class,
            \App\Repositories\TagRepository::class
        );

        $this->app->bind(
            \App\Repositories\UserRepository::class,
            \App\Repositories\UserRepository::class
        );

        // Register Service bindings
        $this->app->bind(
            \App\Services\JobService::class,
            \App\Services\JobService::class
        );

        $this->app->bind(
            \App\Services\JobSearchService::class,
            \App\Services\JobSearchService::class
        );

        $this->app->bind(
            \App\Services\EmployerService::class,
            \App\Services\EmployerService::class
        );

        $this->app->bind(
            \App\Services\ApplicationService::class,
            \App\Services\ApplicationService::class
        );

        $this->app->bind(
            \App\Services\TagService::class,
            \App\Services\TagService::class
        );

        $this->app->bind(
            \App\Services\UserService::class,
            \App\Services\UserService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Application::observe(ApplicationObserver::class);
    }
}
