<?php

namespace Modules\Rate\Factories;

use Illuminate\Database\Eloquent\Model;
use Modules\Rate\Models\Review;

class ReviewFactory
{
    public static function create(): Model
    {
        return new Review();
    }
}