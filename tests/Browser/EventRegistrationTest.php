<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Evenementen;

class EventRegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function test_homepage_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Welkom'); // Or any actual string your homepage contains
        });
    }
    
    public function test_event_page_loads_and_registers()
    {
        // Create a dummy event
        $event = Evenementen::factory()->create([
            'titel' => 'Test Event',
            'datum' => '2025-04-15',
            'starttijd' => '18:00',
            'einddatum' => '2025-04-15',
            'eindtijd' => '20:00',
            'locatie' => 'Testlocatie',
            'beschrijving' => '<p>Test beschrijving</p>',
        ]);

        $this->browse(function (Browser $browser) use ($event) {
            $browser->visit("/events/{$event->id}") // Adjust this route if needed
                ->assertSee('Inschrijven')
                ->type('naam', 'John Doe')
                ->type('email', 'johndoe@example.com')
                ->press('Inschrijven')
                ->assertPathIs("/events/{$event->id}") // stays on same page
                ->assertSee('success'); // Assumes you flash a success message
        });
    }
}
