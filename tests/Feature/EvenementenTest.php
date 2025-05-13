<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EvenementenToevoegen;
use App\Models\Evenementen;

class EvenementenTest extends TestCase
{
    use RefreshDatabase; // Zorgt ervoor dat de database wordt geleegd na elke test

    /** @test */
    public function een_evenement_kan_worden_aangemaakt()
    {
        // Simuleer een POST request met testdata
        $response = $this->post('/events/create', [
            'titel' => 'Test Evenement',
            'datum' => '2025-03-07',
            'starttijd' => '18:00',
            'eindtijd' => '22:00',
            'beschrijving' => 'Dit is een testbeschrijving.',
            'locatie' => 'Test Locatie',
            'aantal_beschikbare_plekken' => 50,
            'betaal_link' => 'https://test-betaal-link.com'
        ]);

        // Controleer of het evenement in de database staat
        $this->assertDatabaseHas('evenementen', [
            'titel' => 'Test Evenement'
        ]);

        // Controleer of de gebruiker wordt doorgestuurd naar de juiste pagina
        $response->assertRedirect('/events/index');
    }
       /** @test */
    public function het_toont_evenementen_geordend_op_startdatum_oplopend()
    {
        // Maak voorbeeld evenementen aan met verschillende datums
        $evenement1 = evenementen::create([
            'titel' => 'Evenement 1',
            'datum' => '2025-03-07',
            'starttijd' => '12:00',
            'eindtijd' => '14:00',
            'beschrijving' => 'Beschrijving van Evenement 1',
            'locatie' => 'Test Locatie',
            'aantal_beschikbare_plekken' => 50,
            'betaal_link' => 'https://evenement1.com',
            'afbeelding' => 'evenement1.jpg'
        ]);

        $evenement2 = evenementen::create([
            'titel' => 'Evenement 2',
            'datum' => '2025-03-07',
            'starttijd' => '12:00',
            'eindtijd' => '14:00',
            'beschrijving' => 'Beschrijving van Evenement 2',
            'locatie' => 'Test Locatie',
            'aantal_beschikbare_plekken' => 50,
            'betaal_link' => 'https://evenement2.com',
            'afbeelding' => 'evenement2.jpg'
        ]);

        $evenement3 = evenementen::create([
            'titel' => 'Evenement 3',
            'datum' => '2025-03-09',
            'starttijd' => '12:00',
            'eindtijd' => '14:00',
            'beschrijving' => 'Beschrijving van Evenement 3',
            'locatie' => 'Test Locatie',
            'aantal_beschikbare_plekken' => 50,
            'betaal_link' => 'https://evenement3.com',
            'afbeelding' => 'evenement3.jpg'
        ]);

        // Haal de pagina op met oplopende volgorde
        $response = $this->get('/events/index?sort=asc');

        // Controleer of de evenementen in oplopende volgorde van datum worden weergegeven
        $response->assertStatus(200);
        $response->assertSeeInOrder([$evenement1->titel, $evenement2->titel, $evenement3->titel]);
    }
}

