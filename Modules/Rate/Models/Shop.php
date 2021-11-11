<?php

namespace Modules\Rate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    protected $table = 'shop';
    
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}