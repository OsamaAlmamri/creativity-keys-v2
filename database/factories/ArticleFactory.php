<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(5);

        return [
            'title' => $title,
            'slug' => fake()->unique()->slug(),
            'category' => fake()->randomElement(['مفاتيح سيارات', 'أقفال ذكية', 'نصائح أمنية', 'طوارئ']),
            'image_url' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80',
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(3, true),
            'read_time' => '3 دقائق قراءة',
            'views_count' => fake()->numberBetween(10, 500),
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}
