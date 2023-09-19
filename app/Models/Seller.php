<?php

namespace App\Models;

use App\Traits\IsUser;
use App\Utils\UUIDHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seller extends Model
{
    use HasFactory, IsUser;

    protected $fillable = [
        'uuid',
        'user_id',
        'token'
    ];

    protected static function boot()
    {
        self::creating(function (Seller $seller) {
            $seller->uuid = $seller->uuid ?? UUIDHelper::generate();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
