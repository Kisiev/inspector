<?php

namespace Modules\Rate\Providers;

use App\Components\Search\BaseSearch;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
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