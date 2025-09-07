<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        "seen",
        'is_special',
        "created_at",
        'location_url',
        'latitude',
        'longitude',
    ];

    protected static function booted()
    {
        static::saving(function ($property) {
            if ($property->location_url) {
                $coords = self::extractCoordinates($property->location_url);

                if ($coords) {
                    $property->latitude = $coords['latitude'];
                    $property->longitude = $coords['longitude'];
                }
            }
        });
    }

    public static function extractCoordinates($url): ?array
    {
        if (preg_match('/goo\.gl\/maps|maps\.app\.goo\.gl/', $url)) {
            $url = self::expandShortUrl($url);
        }

        if (preg_match('/q=([\d\.\-]+),([\d\.\-]+)/', $url, $matches)) {
            return [
                'latitude' => $matches[1],
                'longitude' => $matches[2],
            ];
        }

        if (preg_match('/@([\d\.\-]+),([\d\.\-]+),/', $url, $matches)) {
            return [
                'latitude' => $matches[1],
                'longitude' => $matches[2],
            ];
        }
        return null;
    }

    public static function expandShortUrl($url)
    {
        try {
            Log::debug('Expanding short URL', ['url' => $url]);

            $response = Http::withOptions(['allow_redirects' => false])->get($url);

            if ($response->status() == 301 || $response->status() == 302) {
                $expanded = $response->header('Location');
                return $expanded;
            }
        } catch (\Exception $e) {
            return $url;
        }

        return $url;
    }
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
