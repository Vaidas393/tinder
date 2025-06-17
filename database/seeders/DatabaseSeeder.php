<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // You can call other seeders here, e.g.:
        $this->call(CitySeeder::class);
        $this->call(UserSeeder::class);

    }
}
