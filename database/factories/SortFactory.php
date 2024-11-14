<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sort>
 */
class SortFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'planted' => $this->faker->numberBetween(50000, 100000),
            'collected' => $this->faker->numberBetween(1000, 50000),
            'ordered' => $this->faker->numberBetween(1000, 50000),
            //
        ];
    }
}
