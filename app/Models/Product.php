<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'price'
    ];

    protected static function boot()
    {
        self::creating(function (Product $product) {
            $product->uuid = $product->uuid ?: (string) Str::uuid();
        });
    }

    /**
     * Casting the price to an integer value here so that we do not have to worry about decimal places and rounding
     * in the prices later on.
     * @return Attribute
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => floor($value * 100),
        );
    }

    public function seller(): BelongsToMany
    {
        return $this->belongsToMany(Seller::class, 'seller_products', 'product_id','seller_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }


}
