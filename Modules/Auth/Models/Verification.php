<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string $value
 * @property string $token
 * @property string $code
 * @property string $status
 * @property string $sender_ip
 * @property string $created_at
 * @property string $updated_at
 */
class Verification extends Model
{
    protected $fillable = [
        'code',
        'value',
        'token',
        'type',
        'status'
    ];
}