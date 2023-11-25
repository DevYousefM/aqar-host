<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPlansRequests extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_plan_id", "property_id", "expire_date", "start_date", "status"
    ];

    public function user_plan(): BelongsTo
    {
        return $this->belongsTo(UserPlans::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
