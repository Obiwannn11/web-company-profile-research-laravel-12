<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         $this->call([
            SettingSeeder::class,
            ServiceSeeder::class,
            SiteContentSeeder::class,
            CarouselSeeder::class,
            PublicationSeeder::class,
            ProjectSeeder::class,
            ToolSeeder::class,
            TeamSeeder::class,
            FaqSeeder::class,
            UserSeeder::class,
        ]);
    }
}
