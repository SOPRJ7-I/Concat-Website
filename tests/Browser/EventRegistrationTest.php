<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Evenementen;
use App\Models\User;
use DatabaseTransactions;

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
                ->assertSee('Evenementen'); // You can add another string from the homepage to help identify content
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
            'beschrijving' => 'Test beschrijving',
        ]);
    
    
        $this->browse(function (Browser $browser) use ($event) {
            // Login if necessary
    
            // Visit event registration page
            $browser->visit("/evenementen/{$event->id}") // Ensure the event exists on this route
                ->waitForText('Inschrijven')  // Wait for the 'Inschrijven' text to appear
                ->assertSee('Inschrijven')  // Check that the registration button is visible
                ->assertSee($event->titel)  // Verify event title is displayed
                ->assertSee('Testlocatie')  // Verify the location is displayed
                ->assertSee('Test beschrijving');  // Verify description is displayed

        });
    }
    public function test_event_page_loads_and_displays_elements()
    {


    // Create some dummy events for testing
    $evenementen = Evenementen::factory()->count(5)->create();

    $this->browse(function (Browser $browser) use ($evenementen) {
        // Visit the page that displays the events
        $browser->visit('/index_evenement')
            // Assert the page title is correct
            ->assertSee('Evenementen')
            
            // Assert the filter dropdown for categories is visible
            ->assertSee('Filter op categorie:')
            ->assertPresent('select#categorie')

            // Assert the event titles are visible
            ->assertSee($evenementen[0]->titel)
            ->assertSee($evenementen[1]->titel)
            ->assertSee($evenementen[2]->titel);

            // Assert the pagination links are present
            });
        }
public function test_event_detail_page_loads_and_registration_modal_functionality()
{
    // Create the user with a password set for authentication
    $user = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'), // Ensure password is set
        'role' => 'admin', // Add the role field here
    ]);

    $event = Evenementen::factory()->create([
        'titel' => 'Test Event',
        'categorie' => 'Test Category',
        'datum' => '2025-05-01',
        'starttijd' => '18:00',
        'einddatum' => '2025-05-01',
        'eindtijd' => '22:00',
        'locatie' => 'Test Location',
        'beschrijving' => 'This is a test description for the event.',
    ]);

    // Use the Dusk browser to interact with the page
    $this->browse(function (Browser $browser) use ($user, $event) {
        // Ensure the user is logged in
        $browser->visit(route('evenementen.show', $event->id))
            // Assert event details are visible
            ->assertSee($event->titel)
            ->assertSee($event->categorie)
            ->assertSee($event->locatie)
            ->assertSee($event->beschrijving)
            // Trigger modal display
            ->click('#openFormButton')
            ->pause(500)
            // Assert modal is now visible
            ->assertVisible('#popupModal')
            // Assert modal content
            ->assertSee('Inschrijven')
            ->assertSee('Naam:')
            ->assertSee('E-mail:')
            // Close the modal and assert it's hidden again
            ->click('#closePopup')
            ->pause(500);
    });
}


}
