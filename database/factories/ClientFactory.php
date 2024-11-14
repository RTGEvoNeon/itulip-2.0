<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->unique()->numberBetween(79990000000, 79999999999),
            'other_phone' => $this->faker->unique()->numberBetween(79990000000, 79999999999),
            'comment' => $this->faker->text(30),
            'messenger' => "viber",
            'other_messenger' => "what`s up",
        ];
    }
}
