<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_count' => $this->faker->numberBetween(1000, 50000),
            'price'  => $this->faker->numberBetween(50, 100),
            'prepayment' => 10000,
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'total_count_box' => $this->faker->numberBetween(0, 10),
            'box_price'=> 300,
            'client_id' => $this->faker->numberBetween(1, 30),
        ];
    }
}
