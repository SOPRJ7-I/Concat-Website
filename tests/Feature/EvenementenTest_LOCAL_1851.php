<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Evenementen;

class EvenementenTest extends TestCase
{
    use RefreshDatabase; // Zorgt ervoor dat de database wordt geleegd na elke test

    /** @test */
    public function een_evenement_kan_worden_aangemaakt()
    {
        // Simuleer een POST request met testdata
        $response = $this->post('/create_evenement', [
            'titel' => 'Test Evenement',
            'datum' => '2025-03-07',
            'starttijd' => '18:00',
            'eindtijd' => '22:00',
            'beschrijving' => 'Dit is een testbeschrijving.',
            'locatie' => 'Test Locatie',
            'aantal_beschikbare_plekken' => 50,
            'betaal_link' => 'https://test-betaal-link.com',
            'categorie' => 'Evenement'
        ]);

        // Controleer of het evenement in de database staat
        $this->assertDatabaseHas('evenementen_toevoegen', [
            'titel' => 'Test Evenement'
        ]);

        // Controleer of de gebruiker wordt doorgestuurd naar de juiste pagina
        $response->assertRedirect('/index_evenement');
    }
}
