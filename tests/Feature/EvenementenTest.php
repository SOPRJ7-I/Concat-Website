<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Evenementen;
use PHPUnit\Framework\Attributes\Test;

class EvenementenTest extends TestCase
{
    use RefreshDatabase; // Reset de database na elke test

    #[Test] // PHP 8 attribute
    public function it_displays_events_sorted_by_start_date()
    {
        // Arrange: Maak 3 test evenementen met verschillende startdatums
        $event1 = Evenementen::factory()->create(['start_datum' => '2024-05-01']);
        $event2 = Evenementen::factory()->create(['start_datum' => '2024-03-01']);
        $event3 = Evenementen::factory()->create(['start_datum' => '2024-04-01']);

        // Act: Haal de evenementen op in oplopende volgorde
        $response = $this->get('/evenementen?sort=asc');

        // Assert: Controleer of de evenementen correct gesorteerd zijn
        $response->assertStatus(200);
        $response->assertSeeInOrder([$event2->naam, $event3->naam, $event1->naam]);
    }

    #[Test] 
    public function it_displays_events_in_descending_order_when_sorted_desc()
    {
        // Arrange: Maak testdata
        $event1 = Evenementen::factory()->create(['start_datum' => '2024-05-01']);
        $event2 = Evenementen::factory()->create(['start_datum' => '2024-03-01']);
        $event3 = Evenementen::factory()->create(['start_datum' => '2024-04-01']);

        // Act: Vraag evenementen op in aflopende volgorde
        $response = $this->get('/evenementen?sort=desc');

        // Assert: Controleer of de volgorde correct is
        $response->assertStatus(200);
        $response->assertSeeInOrder([$event1->naam, $event3->naam, $event2->naam]);
    }

    #[Test] 
    public function it_paginates_the_events_correctly()
    {
        // Arrange: Maak 10 test-evenementen
        Evenementen::factory(10)->create();

        // Act: Haal de evenementenpagina op
        $response = $this->get('/evenementen');

        // Assert: Controleer of de paginatie correct werkt
        $response->assertStatus(200);
        $response->assertViewHas('evenementen'); // Check of de variabele bestaat
        $this->assertCount(6, $response->viewData('evenementen')); // Paginate moet 6 items per pagina geven
    }
}
