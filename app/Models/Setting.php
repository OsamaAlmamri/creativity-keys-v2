<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'label',
        'type',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("setting_{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general', ?string $label = null, string $type = 'text'): self
    {
        Cache::forget("setting_{$key}");

        $setting = static::where('key', $key)->first();
        if ($setting) {
            $setting->update(['value' => $value]);

            return $setting;
        }

        return static::create([
            'key' => $key,
            'value' => $value,
            'group' => $group,
            'label' => $label ?? $key,
            'type' => $type,
        ]);
    }

    /**
     * Get the dynamic directions link for Google Maps.
     */
    public static function getDirectionsUrl(): string
    {
        $directUrl = static::get('map_directions_url');
        if (! empty($directUrl)) {
            return $directUrl;
        }

        $lat = trim((string) static::get('map_latitude'));
        $lng = trim((string) static::get('map_longitude'));
        if (! empty($lat) && ! empty($lng)) {
            return "https://www.google.com/maps/dir/?api=1&destination={$lat},{$lng}";
        }

        $embed = (string) static::get('google_map_embed');
        if (! empty($embed) && preg_match('/!2d([0-9\.\-]+)!3d([0-9\.\-]+)/', $embed, $matches)) {
            $extractedLng = $matches[1];
            $extractedLat = $matches[2];

            return "https://www.google.com/maps/dir/?api=1&destination={$extractedLat},{$extractedLng}";
        }

        $address = (string) static::get('address');
        if (! empty($address)) {
            return 'https://www.google.com/maps/search/?api=1&query='.urlencode($address);
        }

        $city = (string) static::get('city_name', 'الرياض');

        return 'https://www.google.com/maps/search/?api=1&query='.urlencode($city.' مفاتيح');
    }

    /**
     * Get the embedded map iframe source.
     */
    public static function getMapEmbedUrl(): string
    {
        $embed = (string) static::get('google_map_embed');
        if (! empty($embed)) {
            return $embed;
        }

        $lat = trim((string) static::get('map_latitude'));
        $lng = trim((string) static::get('map_longitude'));
        if (! empty($lat) && ! empty($lng)) {
            return "https://maps.google.com/maps?q={$lat},{$lng}&hl=ar&z=15&output=embed";
        }

        $city = (string) static::get('city_name', 'الرياض');

        return 'https://maps.google.com/maps?q='.urlencode($city).'&hl=ar&z=14&output=embed';
    }
}
