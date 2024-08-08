<?php

namespace Database\Seeders;

use App\Models\supply;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class supplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        supply::factory(5)->create();
    }
}
