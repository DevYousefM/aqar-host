<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscribeCompanyPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "company_plan_id",
        "remaining_properties",
        "remaining_special",
        "remaining_facebook_ads",
        "remaining_youtube_ads",
        "remaining_google_ads",
        "start_date",
        "end_date",
        "status",
    ];

    public function company_plan(): BelongsTo
    {
        return $this->belongsTo(CompanyPlans::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
