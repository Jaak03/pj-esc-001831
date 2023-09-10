<?php

namespace App\Models;

use App\Utils\UUIDHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
    ];

    protected static function boot()
    {
        self::creating(function (Seller $seller) {
            $seller->uuid = $seller->uuid ?? UUIDHelper::generate();
        });
    }
}
