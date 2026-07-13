<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Luôn sinh URL HTTPS khi chạy production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('delete-content', function ($user, $model) {
            return $user->role_id === '2' && $user->id === $model->user_id;
        });
    }
}