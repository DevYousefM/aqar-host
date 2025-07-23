<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SingleServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "single_service_id",
        "status"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function single_service(): BelongsTo
    {
        return $this->belongsTo(SingleService::class);
    }
}
