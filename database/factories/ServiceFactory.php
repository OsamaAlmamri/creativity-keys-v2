<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(3, true);

        return [
            'title' => $title,
            'slug' => fake()->unique()->slug(),
            'icon' => 'key',
            'short_description' => fake()->sentence(8),
            'full_description' => fake()->paragraph(),
            'price_starting_at' => 'يبدأ من 100 ر.س',
            'features' => ['ميزة 1', 'ميزة 2', 'ميزة 3'],
            'is_emergency' => fake()->boolean(30),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
