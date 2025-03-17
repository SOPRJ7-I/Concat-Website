<?php

namespace Database\Seeders;

use App\Models\Evenement;
use App\Models\Evenementen;
use Illuminate\Database\Seeder;

class EvenementenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Evenementen::create([
            'titel' => 'Tech Conferentie 2025',
            'beschrijving' => 'Een wereldwijde technologieconferentie met de nieuwste ontwikkelingen op het gebied van technologie, AI en innovatie.',
            'locatie' => 'Utrecht',
            'datum' => '2025-06-10',
            'starttijd' => '09:00:00',
            'eindtijd' => '18:00:00',
            'aantal_beschikbare_plekken' => 500,
            'betaal_link' => 'https://techconference2025.com/tickets',
            'afbeelding' => 'tech_conferentie.jpg',
        ]);

        Evenementen::create([
            'titel' => 'Food Festival Amsterdam',
            'beschrijving' => 'Een viering van eten van over de hele wereld, met livemuziek en kookdemonstraties.',
            'locatie' => 'Amsterdam',
            'datum' => '2025-07-20',
            'starttijd' => '11:00:00',
            'eindtijd' => '23:00:00',
            'aantal_beschikbare_plekken' => 1000,
            'betaal_link' => 'https://foodfestivalamsterdam.com/tickets',
            'afbeelding' => 'food_festival.jpg',
        ]);

        Evenementen::create([
            'titel' => 'Kunst Expo 2025',
            'beschrijving' => 'Een tentoonstelling met hedendaagse kunst, met werken van zowel bekende als opkomende kunstenaars.',
            'locatie' => 'Rotterdam',
            'datum' => '2025-09-05',
            'starttijd' => '10:00:00',
            'eindtijd' => '18:00:00',
            'aantal_beschikbare_plekken' => 300,
            'betaal_link' => 'https://artexpo2025.com/tickets',
            'afbeelding' => 'kunst_expo.jpg',
        ]);

        Evenementen::create([
            'titel' => 'Filmfestival Leiden',
            'beschrijving' => 'Een internationaal filmfestival met vertoningen van onafhankelijke en buitenlandse films.',
            'locatie' => 'Leiden',
            'datum' => '2025-08-15',
            'starttijd' => '12:00:00',
            'eindtijd' => '23:00:00',
            'aantal_beschikbare_plekken' => 400,
            'betaal_link' => 'https://filmfestivalleiden.com/tickets',
            'afbeelding' => 'film_festival.jpg',
        ]);

        Evenementen::create([
            'titel' => 'Muziekfestival Den Haag',
            'beschrijving' => 'Een bruisend muziekfestival met optredens van zowel lokale als internationale artiesten.',
            'locatie' => 'Den Haag',
            'datum' => '2025-06-30',
            'starttijd' => '13:00:00',
            'eindtijd' => '01:00:00',
            'aantal_beschikbare_plekken' => 700,
            'betaal_link' => 'https://musicfestivalthehague.com/tickets',
            'afbeelding' => 'muziek_festival.jpg',
        ]);

        Evenementen::create([
            'titel' => 'Kerstmarkt Maastricht',
            'beschrijving' => 'Een magische kerstmarkt met feestelijke verlichting, eetkraampjes en kerstliederen.',
            'locatie' => 'Maastricht',
            'datum' => '2025-12-01',
            'starttijd' => '10:00:00',
            'eindtijd' => '20:00:00',
            'aantal_beschikbare_plekken' => 2000,
            'betaal_link' => 'https://christmasmarketmaastricht.com/tickets',
            'afbeelding' => 'kerstmarkt.jpg',
        ]);

        Evenementen::create([
            'titel' => 'Zomerstrandfeest',
            'beschrijving' => 'Doe mee voor een dag vol plezier in de zon met strandspellen, muziek en heerlijk eten.',
            'locatie' => 'Scheveningen',
            'datum' => '2025-07-10',
            'starttijd' => '14:00:00',
            'eindtijd' => '22:00:00',
            'aantal_beschikbare_plekken' => 600,
            'betaal_link' => 'https://summerbeachparty.com/tickets',
            'afbeelding' => 'strandfeest.jpg',
        ]);

        Evenementen::create([
            'titel' => 'Internationaal Dansfestival',
            'beschrijving' => 'Een festival voor dansliefhebbers, met workshops, optredens en wedstrijden.',
            'locatie' => 'Rotterdam',
            'datum' => '2025-10-10',
            'starttijd' => '09:00:00',
            'eindtijd' => '20:00:00',
            'aantal_beschikbare_plekken' => 800,
            'betaal_link' => 'https://dancefestivalrotterdam.com/tickets',
            'afbeelding' => 'dansfestival.jpg',
        ]);
    }
}
