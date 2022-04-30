<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomNumber(4),
            'color' => $this->faker->safeColorName(),
            'size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
            'weight' => $this->faker->randomFloat(2, 1),
            'price_cents' => $this->faker->randomNumber(4, true),
            'sale_price_cents' => $this->faker->randomNumber(4, true),
            'cost_cents' => $this->faker->randomNumber(4, true),
            'sku' => strtoupper($this->faker->lexify('?????')),
            'length' => $this->faker->randomDigitNotNull(),
            'width' => $this->faker->randomDigitNotNull(),
            'height' => $this->faker->randomDigitNotNull(),
            'note' => '',
        ];
    }
}
