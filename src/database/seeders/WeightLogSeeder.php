<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class WeightLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [];

        // 例：35件作る（要件が35件ならこれ）
        for ($i = 0; $i < 35; $i++) {
            $rows[] = [
                'user_id' => 1,
                'date' => now()->subDays($i)->toDateString(),
                'weight' => 60.0 + ($i * 0.1),   // 60.0, 60.1, 60.2...
                'calories' => 1800,
                'exercise_time' => '00:30:00',
                'exercise_content' => 'ウォーキング',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('weight_logs')->insert($rows);
    }
}
