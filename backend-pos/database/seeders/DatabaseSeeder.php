<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\brandSeeder;
use Database\Seeders\supplySeeder;
use Database\Seeders\categorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            brandSeeder::class,
            supplySeeder::class,
            categorySeeder::class
        ]);
    }
}
