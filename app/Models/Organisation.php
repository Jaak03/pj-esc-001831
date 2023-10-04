<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'organisation_name',
        'trade_name',
        'organisation_type',
        'registration_number',
        'tax_number',
    ];
}
