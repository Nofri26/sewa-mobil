<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rental extends Model
{
    public $fillable = [
        'start',
        'end',
        'status',
        'cost',
        'car_id',
        'created_by_id',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function returnRentals(): HasMany
    {
        return $this->hasMany(ReturnRental::class);
    }
}
