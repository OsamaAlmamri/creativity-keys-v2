<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'client_title' => 'حي '.fake()->city(),
            'rating' => fake()->numberBetween(4, 5),
            'comment' => fake()->paragraph(),
            'service_rendered' => fake()->randomElement(['فتح باب', 'برمجة ريموت', 'تركيب قفل ذكي']),
            'avatar_url' => null,
            'is_approved' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
