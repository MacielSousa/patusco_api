<?php

namespace App\Providers;

use App\Models\Consult;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('list-consult', function(User $user, Consult $consult){
            return $user->id === $consult->user_id;
        });
    }
}
