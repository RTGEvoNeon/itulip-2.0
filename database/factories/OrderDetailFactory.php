<?php

namespace Database\Factories;

use App\Models\Sort;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $sorts = Sort::pluck('id')->toArray();
        return [
            'order_id' => 3,
            'sort_id' => $this->faker->randomElement($sorts),
            'count' => 10000,
        ];
    }
}
