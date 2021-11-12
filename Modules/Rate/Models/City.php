<?php

namespace Modules\Rate\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class City extends Model
{
    protected $table = 'city';
    public $timestamps = false;
}