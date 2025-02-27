<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'name' => 'Laravel Workshop',
                'description' => 'Een workshop over Laravel en PHP.',
                'start_date' => '2025-03-01 18:00:00',
                'end_date' => '2025-03-01 22:00:00',
                'location' => 'Den Bosch',
                'ticket_link' => 'https://www.example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tech Meetup',
                'description' => 'Een bijeenkomst voor tech-liefhebbers.',
                'start_date' => '2025-04-15 19:00:00',
                'end_date' => '2025-04-15 23:00:00',
                'location' => 'Eindhoven',
                'ticket_link' => 'https://www.example.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
