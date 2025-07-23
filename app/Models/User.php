<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    protected $fillable = [
        'name',
        'company_name',
        'company_brief',
        'company_type',
        'email',
        'phone',
        'phone_sec',
        'location',
        'account_type',
        "image",
        "property_charge",
        "is_important",
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $appends = ["has_special"];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function company_projects(): HasMany
    {
        return $this->hasMany(CompanyProject::class);
    }

    public function company_plans_sub(): HasMany
    {
        return $this->hasMany(SubscribeCompanyPlan::class);
    }

    public function getHasSpecialAttribute()
    {
        if (!empty(auth()->user()->company_plans_sub)) {
            $props = auth()->user()->company_plans_sub->where("status", "active")->where("remaining_special", ">", 0);
            $has_special = count($props) > 0;
            return $has_special;
        }
        return false;
    }
}
