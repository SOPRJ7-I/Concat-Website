<?php

namespace Database\Seeders;

use App\Models\Evenementen;
use Illuminate\Database\Seeder;

class EvenementenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed Example 1
        Evenementen::create([
            'naam' => 'Tech Conference 2025',
            'beschrijving' => 'A global tech conference featuring the latest in technology, AI, and innovation.',
            'locatie' => 'Utrecht',
            'start_datum' => '2025-06-10 09:00:00',
            'eind_date' => '2025-06-10 18:00:00',
            'ticket_link' => 'https://techconference2025.com/tickets',
        ]);

        // Seed Example 2
        Evenementen::create([
            'naam' => 'Food Festival Amsterdam',
            'beschrijving' => 'A celebration of food from all over the world, with live music and cooking demonstrations.',
            'locatie' => 'Amsterdam',
            'start_datum' => '2025-07-20 11:00:00',
            'eind_date' => '2025-07-20 23:00:00',
            'ticket_link' => 'https://foodfestivalamsterdam.com/tickets',
        ]);

        // Seed Example 3
        Evenementen::create([
            'naam' => 'Art Expo 2025',
            'beschrijving' => 'An exhibition showcasing contemporary art, with works from both well-known and emerging artists.',
            'locatie' => 'Rotterdam',
            'start_datum' => '2025-09-05 10:00:00',
            'eind_date' => '2025-09-07 18:00:00',
            'ticket_link' => 'https://artexpo2025.com/tickets',
        ]);

        // Seed Example 4
        Evenementen::create([
            'naam' => 'Film Festival Leiden',
            'beschrijving' => 'An international film festival with screenings of independent and foreign films.',
            'locatie' => 'Leiden',
            'start_datum' => '2025-08-15 12:00:00',
            'eind_date' => '2025-08-22 23:00:00',
            'ticket_link' => 'https://filmfestivalleiden.com/tickets',
        ]);

        // Seed Example 5
        Evenementen::create([
            'naam' => 'Music Festival The Hague',
            'beschrijving' => 'A vibrant music festival featuring performances from local and international artists.',
            'locatie' => 'Den Haag',
            'start_datum' => '2025-06-30 13:00:00',
            'eind_date' => '2025-07-01 01:00:00',
            'ticket_link' => 'https://musicfestivalthehague.com/tickets',
        ]);

        // Seed Example 6
        Evenementen::create([
            'naam' => 'Christmas Market Maastricht',
            'beschrijving' => 'A magical Christmas market with festive lights, food stalls, and Christmas music.',
            'locatie' => 'Maastricht',
            'start_datum' => '2025-12-01 10:00:00',
            'eind_date' => '2025-12-24 20:00:00',
            'ticket_link' => 'https://christmasmarketmaastricht.com/tickets',
        ]);

        // Seed Example 7
        Evenementen::create([
            'naam' => 'Summer Beach Party',
            'beschrijving' => 'Join us for a day of fun in the sun with beach games, music, and great food.',
            'locatie' => 'Scheveningen',
            'start_datum' => '2025-07-10 14:00:00',
            'eind_date' => '2025-07-10 22:00:00',
            'ticket_link' => 'https://summerbeachparty.com/tickets',
        ]);

        // Seed Example 8
        Evenementen::create([
            'naam' => 'International Dance Festival',
            'beschrijving' => 'A festival for dance lovers, featuring workshops, performances, and competitions.',
            'locatie' => 'Rotterdam',
            'start_datum' => '2025-10-10 09:00:00',
            'eind_date' => '2025-10-12 20:00:00',
            'ticket_link' => 'https://dancefestivalrotterdam.com/tickets',
        ]);
    }
}
