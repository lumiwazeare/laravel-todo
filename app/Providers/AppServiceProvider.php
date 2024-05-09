<?php

namespace App\Providers;

use App\TodoServices\TaskService;
use App\TodoServices\TodoService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaskService::class, function (Application $app) {
            return new TaskService();
        });

        $this->app->singleton(TodoService::class, function (Application $app) {
            return new TodoService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
