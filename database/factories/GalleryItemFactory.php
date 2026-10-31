<?php

namespace Database\Factories;

use App\Models\GalleryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GalleryItem>
 */
class GalleryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'category' => fake()->randomElement(['مفاتيح سيارات', 'أقفال ذكية', 'طوارئ وفتح أبواب']),
            'image_url' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80',
            'description' => fake()->sentence(),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
