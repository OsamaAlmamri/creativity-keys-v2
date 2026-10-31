<?php

namespace App\Models;

use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'icon',
        'short_description',
        'full_description',
        'price_starting_at',
        'features',
        'is_emergency',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_emergency' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    protected static function booted(): void
    {
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title).'-'.Str::random(5);
            }
        });
    }
}
