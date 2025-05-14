<?php

namespace Database\Seeders;

use App\Models\CommunityNight;
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
        CommunityNight::factory(50)->create();
        $this->call(EvenementenSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call([AnnouncementSeeder::class,]);
        $this->call(SponsorSeeder::class);
    }
}
