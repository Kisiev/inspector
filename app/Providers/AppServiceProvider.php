<?php

namespace App\Providers;

use App\Components\Validation\ValidationEntity;
use App\Components\Validation\ValidationEntityInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ValidationEntityInterface::class, ValidationEntity::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
