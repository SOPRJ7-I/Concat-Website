<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Rooster;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RoosterCalendarTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testRoosterCalendarPageIsAccessible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/rooster')
                    ->assertPathIs('/rooster');
        });
    }
    /** @test */
    public function user_can_add_and_interact_with_rooster()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/roosters') 
                ->waitFor('[data-dusk="input-ical-url"]', 5)
                ->type('[data-dusk="input-ical-url"]', 'https://rooster.avans.nl/gcal/test-ical-url')
                ->select('[data-dusk="select-klas"]', '1')
                ->press('[data-dusk="btn-add-rooster"]')
                ->waitFor('[data-dusk="form-success"]', 5)
                ->assertSee('Roosterlink opgeslagen!'); 

            // Optional: Test the chart updates
            $browser->pause(1000)
                ->click('[data-dusk="calendar-day-2025-06-05"]') // 
                ->assertVisible('[data-dusk="hourly-chart"]');
        });
    }
}
