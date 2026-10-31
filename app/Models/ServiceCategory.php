<?php

namespace App\Models;

use Database\Factories\ServiceCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ServiceCategory extends Model
{
    /** @use HasFactory<ServiceCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id')->orderBy('sort_order');
    }

    protected static function booted(): void
    {
        static::creating(function (ServiceCategory $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name).'-'.Str::random(4);
            }
        });
    }
}
