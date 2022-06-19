<?php

namespace Modules\Rate\Providers;

use App\Components\Search\BaseSearch;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Rate\Events\RateEvent;
use Modules\Rate\Handlers\RateCreateHandler;
use Modules\Rate\Http\Controllers\CityController;
use Modules\Rate\Http\Controllers\ShopController;
use Modules\Rate\Repositories\CityRepository;
use Modules\Rate\Repositories\ShopRepository;
use Modules\Rate\Services\City\CitySearch;
use Modules\Rate\Services\Shop\ShopSearch;

class RateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootstrap();
        $this->events();
    }
    
    public function events(): void
    {
        Event::listen(
            RateEvent::class,
            [RateCreateHandler::class, 'handle']
        );
    }
    
    public function bootstrap(): void
    {
        $this->app->when(CitySearch::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(CityRepository::class);
            });
        
        $this->app->when(CityController::class)
            ->needs(BaseSearch::class)
            ->give(function() {
                return app(CitySearch::class);
            });
        
        $this->app->when(ShopSearch::class)
            ->needs(BaseRepository::class)
            ->give(function() {
                return app(ShopRepository::class);
            });
        
        $this->app->when(ShopController::class)
            ->needs(BaseSearch::class)
            ->give(function() {
                return app(ShopSearch::class);
            });
    }
}