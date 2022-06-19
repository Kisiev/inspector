<?php

namespace Modules\Rate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $lat
 * @property string $long
 * @property string $rate
 * @property int    $city_id
 * @property double $reviews_value
 * @property int    $reviews_count
 * @property City   $city
 */
class Shop extends Model
{
    protected $table = 'shop';
    
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}