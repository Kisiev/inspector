<?php

namespace Modules\Auth\Providers;

use App\Components\Forms\BaseForm;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Dto\RegisterUserDto;
use Modules\Auth\Forms\RegisterForm;
use Modules\Auth\Forms\VerificationCreateForm;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\VerificationController;
use Modules\Auth\Repositories\VerificationRepository;
use Modules\Auth\Services\Register\RegisterService;
use Modules\Auth\Services\Register\RegisterUserInterface;
use Modules\Auth\Services\Verification\ConfirmedInterface;
use Modules\Auth\Services\Verification\EmailVerificationInterface;
use Modules\Auth\Services\Verification\EmailVerificationService;
use Modules\Auth\Services\Verification\VerificationConfirmedService;
use Modules\User\Repositories\UserRepository;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\UserCreateInterface;

class RegisterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(VerificationController::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(UserRepository::class);
            });
        
        $this->app->when(VerificationController::class)
            ->needs(BaseForm::class)
            ->give(function() {
                return app(VerificationCreateForm::class);
            });
        
        $this->app->when(CreateUserService::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(UserRepository::class);
            });
        
        $this->app->when(EmailVerificationService::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(VerificationRepository::class);
            });
        
        $this->app->when(VerificationConfirmedService::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(VerificationRepository::class);
            });
        
        $this->app->when(RegisterController::class)
            ->needs(RegisterUserInterface::class)
            ->give(function() {
                return app(RegisterService::class);
            });
        
        $this->app->when(RegisterController::class)
            ->needs(BaseForm::class)
            ->give(function() {
                return app(RegisterForm::class);
            });
        
        $this->app->instance(ConfirmedInterface::class, app(VerificationConfirmedService::class));
        $this->app->instance(UserCreateInterface::class, app(CreateUserService::class));
        $this->app->instance(RegisterUserInterface::class, app(RegisterService::class));
        $this->app->instance(EmailVerificationInterface::class, app(EmailVerificationService::class));
        
    }
}