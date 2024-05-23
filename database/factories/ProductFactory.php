<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**php tinker artisan for dummy data */
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'thumb_img' => '/uploads/test.jpg',
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'short_description' => $this->faker->paragraph(),
            'long_description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'sku' => $this->faker->unique()->ean13(),
            'seo_title' => $this->faker->sentence(),
            'seo_description' => $this->faker->paragraph(),
            'show_at_home' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
        ];
    }
}
