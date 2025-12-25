<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class WeightTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                DB::table('weight_targets')->insert([
            'user_id' => 1,
            'target_weight' => 60.0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
