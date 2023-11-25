<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'brief',
        'type',
        'purpose',
        'gov',
        'area',
        'level',
        'rooms',
        'meters',
        'payment',
        'presenter',
        'price',
        'is_special',
        "created_at"
    ];

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user_request(): HasMany
    {
        return $this->hasMany(UserPlansRequests::class);
    }
}
