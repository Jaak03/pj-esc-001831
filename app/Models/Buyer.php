<?php

namespace App\Models;

use App\Traits\IsUser;
use App\Utils\UUIDHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory, IsUser;

    protected $fillable = [
        'uuid',
        'user_id',
    ];

    protected static function boot()
    {
        self::created(function (Buyer $buyer) {
            $buyer->uuid = $buyer->uuid ?: UUIDHelper::generate();
            $buyer->save();
        });
    }
}
