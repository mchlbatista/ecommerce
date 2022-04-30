<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password_hash' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password_plain' => 'password', // password
            'superadmin' => false,
            'remember_token' => Str::random(10),
            'card_brand' => $this->faker->word(),
            'card_last_four' => $this->faker->randomNumber(4, true),
            'shop_domain' => $this->faker->word(),
            'shop_name' => $this->faker->word(),
            'is_enable' => true,
            'billing_plan' => 'Enterprise',

        ];
    }
}
