<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        self::created(function (Product $product) {
            $product->uuid = $product->uuid ?: (string) Str::uuid();
            $product->save();
        });
    }

    public function seller()
    {
        return $this->belongsToMany(Seller::class, 'seller_products', 'product_id','seller_id');
    }
}
