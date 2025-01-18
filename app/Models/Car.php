<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    public $fillable = [
        'brand',
        'model',
        'plate_number',
        'daily_rate',
        'is_available',
        'created_by_id'
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
