<?php

namespace Tests\Browser;

use App\Models\Announcement;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;

class AnnouncementPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_create_announcement_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/announcements/create')
                ->assertSee('Announcement aanmaken')
                ->assertPresent('input[name="titel"]')
                ->assertPresent('textarea[name="inhoud"]')
                ->assertPresent('input[name="publicatiedatum"]')
                ->assertPresent('input[name="vervaldatum"]')
                ->assertPresent('input[type="submit"]');
        });
    }

    /** @test */
    public function user_can_view_edit_announcement_form()
    {
        $announcement = Announcement::create([
            'titel' => 'Test Titel',
            'inhoud' => 'Dit is een testinhoud.',
            'publicatiedatum' => Carbon::now(),
            'vervaldatum' => Carbon::now()->addDays(7),
        ]);

        $this->browse(function (Browser $browser) use ($announcement) {
            $browser->visit("/announcements/{$announcement->id}/edit")
                ->assertSee('Announcement bewerken')
                ->assertInputValue('titel', 'Test Titel')
                ->assertPresent('textarea[name="inhoud"]')
                ->assertPresent('input[name="publicatiedatum"]')
                ->assertPresent('input[name="vervaldatum"]')
                ->assertPresent('input[type="submit"]');
        });
    }

    /** @test */
    public function user_can_view_announcement_overview()
    {
        $announcement = Announcement::create([
            'titel' => 'Overzicht Test',
            'inhoud' => 'Dit is de inhoud voor het overzicht.',
            'publicatiedatum' => Carbon::now(),
            'vervaldatum' => Carbon::now()->addDays(3),
        ]);

        $this->browse(function (Browser $browser) use ($announcement) {
            $browser->visit('/announcements')
                ->assertSee('Overzicht van announcements')
                ->assertSee('Overzicht Test')
                ->assertSee('Dit is de inhoud voor het overzicht.')
                ->assertPresent("[dusk='delete-announcement-{$announcement->id}']");
        });
    }
}
