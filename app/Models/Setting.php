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

        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'label' => $label ?? $key,
                'type' => $type,
            ]
        );
    }
}
