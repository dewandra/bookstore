<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $ratings = [];

        for ($i = 0; $i < 500000; $i++) {
            $ratings[] = [
                'book_id' => rand(1, 100000),
                'rating' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($ratings) === 1000) {
                DB::table('ratings')->insert($ratings);
                $ratings = [];
            }
        }

        if (count($ratings)) {
            DB::table('ratings')->insert($ratings);
        }
    }
}
