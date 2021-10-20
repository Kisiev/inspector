<?php

namespace Modules\User\Providers;

use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\FindUserInterface;
use Modules\User\Services\UserCreateInterface;
use Modules\User\Services\UserService;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(CreateUserService::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(UserRepository::class);
            });
        
        $this->app->when(UserService::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(UserRepository::class);
            });
        
        $this->app->instance(UserCreateInterface::class, app(CreateUserService::class));
        $this->app->instance(FindUserInterface::class, app(UserService::class));
    }
}