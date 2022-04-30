<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'style' => $this->faker->text(),
            'brand' => $this->faker->word(),
            'url' => $this->faker->url(),
            'product_type' => $this->faker->word(),
            'shipping_price' => $this->faker->randomNumber(4, true),
            'note' => ''
        ];
    }
}
