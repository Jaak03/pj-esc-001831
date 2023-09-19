<?php

namespace App\Models;

use App\Traits\IsUser;
use App\Utils\UUIDHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buyer extends Model
{
    use HasFactory, IsUser;

    protected $fillable = [
        'uuid',
        'user_id',
        'token'
    ];

    protected static function boot()
    {
        self::created(function (Buyer $buyer) {
            $buyer->uuid = $buyer->uuid ?: UUIDHelper::generate();
            $buyer->save();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createToken(): Buyer
    {
        $token = $this->user->createToken('TradeSafe')->plainTextToken;
        $this->user->token = $token;
        $this->user->save();
        return $this;
    }
}
