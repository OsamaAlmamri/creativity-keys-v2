<?php

namespace App\Models;

use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'badge',
        'hero_subtitle',
        'overview_title',
        'overview_content',
        'features_title',
        'process_title',
        'steps',
        'pricing_title',
        'pricing_note',
        'features',
        'is_emergency',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'steps' => 'array',
            'is_emergency' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function featuresList(): HasMany
    {
        return $this->hasMany(ServiceFeature::class)->orderBy('sort_order')->orderBy('id');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceFaq::class)->orderBy('sort_order')->orderBy('id');
    }

    public function pricingTiers(): HasMany
    {
        return $this->hasMany(ServicePricingTier::class)->orderBy('sort_order')->orderBy('id');
    }

    public function getImageUrlAttribute(): string
    {
        $map = [
            'car-keys-programming' => '/images/store/800_gi-6abfd921d9050.jpg',
            'car-remotes-repair-programming' => '/images/store/800_6abfe0ca2391c.jpg',
            'emergency-car-lockout' => '/images/store/800_gi-6abfd95c4c431.jpg',
            'laser-car-keys-cutting' => '/images/store/800_6abfe2761228b.jpg',
            'home-door-locksmith' => '/images/store/800_6abfe27712dff.jpg',
            'safes-vaults-smart-locks' => '/images/store/800_gi-6abfd921d9048.jpg',
            // Legacy fallbacks
            'car-keys-and-remotes-programming' => '/images/store/800_gi-6abfd921d9050.jpg',
            'smart-fob-and-standard-remotes-coding' => '/images/store/800_6abfe0ca2391c.jpg',
            'transponder-lost-car-keys-duplication' => '/images/store/800_6abfe2761228b.jpg',
            'ford-mykey-system-reset-disable' => '/images/store/800_gi-6abfd921d902f.jpg',
            'ignition-switch-and-car-locks-repair' => '/images/store/800_gi-6abfd921d9040.jpg',
            'emergency-apartments-cars-lockout' => '/images/store/800_gi-6abfd95c4c431.jpg',
            'car-keys-repair-home-unlocking' => '/images/store/800_6abfe27712dff.jpg',
            'lost-keys-replacement-all-locks' => '/images/store/800_gi-6abfd921d9038.jpg',
            'doors-cars-safes-programming' => '/images/store/800_gi-6abfd921d9048.jpg',
        ];

        return $map[$this->slug] ?? '/images/store/800_gi-6abfd921d9038.jpg';
    }

    public function getBadgeTextAttribute(): string
    {
        if (! empty($this->badge)) {
            return $this->badge;
        }

        if ($this->is_emergency) {
            return 'طوارئ 24/7';
        }

        $map = [
            'car-keys-programming' => 'تقنية ذكية',
            'car-remotes-repair-programming' => 'صيانة فورية',
            'emergency-car-lockout' => 'طوارئ سريعة',
            'laser-car-keys-cutting' => 'ليزر CNC',
            'home-door-locksmith' => 'أمان المنازل',
            'safes-vaults-smart-locks' => 'أمان فائق',
        ];

        return $map[$this->slug] ?? 'متميز';
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
