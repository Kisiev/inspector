<?php

namespace Modules\Rate\Handlers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Rate\Events\RateEvent;
use Modules\Rate\Repositories\ShopRepository;

class RateCreateHandler implements ShouldQueue
{
    private ShopRepository $repository;

    public function __construct(ShopRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Handle the event.
     *
     * @param RateEvent $event
     *
     * @return void
     */
    public function handle(RateEvent $event): void
    {
        $review = $event->review;
        $shop = $review->shop;
        
        $reviewsValue = ($shop->reviews_value + $review->rate);
        $shop->reviews_count ++;
        $shop->rate = $reviewsValue / $shop->reviews_count;
        $shop->reviews_value = $reviewsValue;
        $this->repository->save($shop);
    }
}