<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Product> */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category' => 'Eyewear',
            'name' => fake()->words(2, true),
            'image_path' => 'assets/img/products/eyewear.jpg',
            'price' => fake()->randomFloat(2, 25, 150),
            'description' => fake()->sentence(),
            'stock' => 10,
            'is_featured' => false,
        ];
    }
}
