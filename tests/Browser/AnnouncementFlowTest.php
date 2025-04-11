<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Announcement;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AnnouncementFlowTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function full_crud_flow_for_announcements()
    {
        $user = User::factory()->create();

        // Create test
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/announcements/create')
                ->type('titel', 'Nieuw Event')
                ->type('inhoud', 'Beschrijving van het nieuwe event')
                ->type('publicatiedatum', now()->format('Y-m-d\TH:i'))
                ->press('Toevoegen')
                ->assertPathIs('/announcements')
                ->assertSee('Nieuw Event');
        });

        // Index test
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/announcements')
                ->assertSee('Nieuw Event')
                ->assertSee('Beschrijving van het nieuwe event');
        });

        // Edit test
        $announcement = Announcement::first();

        $this->browse(function (Browser $browser) use ($user, $announcement) {
            $browser->loginAs($user)
                ->visit("/announcements/{$announcement->id}/edit")
                ->type('titel', 'Aangepast Event')
                ->type('inhoud', 'Aangepaste beschrijving')
                ->press('Opslaan')
                ->assertPathIs('/announcements')
                ->assertSee('Aangepast Event');
        });
    }

    /** @test */
    public function it_shows_validation_errors_on_create()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/announcements/create')
                ->press('Toevoegen')
                ->assertSee('The titel field is required')
                ->assertSee('The inhoud field is required')
                ->assertSee('The publicatiedatum field is required');
        });
    }
}