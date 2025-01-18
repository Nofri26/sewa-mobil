<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnRental extends Model
{
    public $fillable = [
        'return_date',
        'days',
        'cost',
        'rental_id',
    ];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }
}
