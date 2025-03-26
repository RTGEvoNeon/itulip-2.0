<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

    /**
     * Run the database seeds.
     */
    use App\Models\Order;
    use App\Models\Sort;

class OrderDetailSeeder extends Seeder
{

    public function run(): void
    {
        $sortIds = Sort::pluck('id')->toArray();
        $orderIds = Order::pluck('id')->toArray();
    
        foreach (range(1, 30) as $_) {
            OrderDetail::factory()->create([
                'sort_id' => fake()->randomElement($sortIds),
                'order_id' => fake()->randomElement($orderIds),
            ]);
        }
    }
    
}
