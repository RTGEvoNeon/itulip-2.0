<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\ClientSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\OrderDetailSeeder;
use Database\Seeders\SortSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate(); 
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    
        $this->call([
            SortSeeder::class,
            ClientSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
        ]);
    }
    
}
