<?php

namespace Modules\Rate\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Rate\Models\Review;

class RateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Review $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}