<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use App\Models\Sort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sort::factory()->count(100)->create();
    }
}
