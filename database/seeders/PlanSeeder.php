<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Domain\Models\Plan::create([
            'id' => str()->uuid(),
            'slug' => 'Gold',
            'price' => 10,
            'duration_in_days' => 30
        ]);
    }
}
