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
    public int $oldRate = 0;

    public function __construct(Review $review, int $oldRate = 0)
    {
        $this->review = $review;
        $this->oldRate = $oldRate;
    }
}