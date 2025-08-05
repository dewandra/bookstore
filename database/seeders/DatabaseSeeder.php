<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AuthorSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            RatingSeeder::class,
        ]);

    $this->command->info('Calculating book ratings...');
    Artisan::call('books:calculate-ratings');
    
    $this->command->info('Calculating author voters...');
    Artisan::call('authors:calculate-voters');
    }
}
