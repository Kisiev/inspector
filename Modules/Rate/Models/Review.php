<?php

namespace Modules\Rate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Models\User;

/**
 * @property int $shop_id
 * @property int $user_id
 * @property int $text
 * @property int $type
 * @property int $rate
 * @property int $id
 * @property Shop $shop
 */
class Review extends Model
{
    protected $table = 'review';
    protected $fillable = [
        'shop_id',
        'user_id',
        'text',
        'type',
        'rate',
        'id'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}