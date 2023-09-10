<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait IsUser
{
    use UsesTradeSafe;

    /**
     * Returns the user relationship that this entity belongs too.
     * @return mixed
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
