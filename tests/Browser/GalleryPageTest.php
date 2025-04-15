<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GalleryPageTest extends DuskTestCase
{
    /** @test */
    public function user_can_view_gallery_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/gallery')
                ->assertSee('Gallerij')
                ->assertPresent('#sorteren')
                ->assertVisible('[aria-label^="Bekijk foto"]');
        });
    }

    /** @test */
    public function user_can_open_and_close_modal()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/gallery')
                ->waitFor('[aria-label^="Bekijk foto"]')
                ->click('[aria-label^="Bekijk foto"]')
                ->pause(300)
                ->assertVisible('#photoModal')
                ->click('button[aria-label="Sluit modal"]')
                ->pause(300)
                ->assertMissing('#photoModal.flex');
        });
    }

    /** @test */
    public function user_can_select_sort_option()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/gallery')
                ->assertPresent('select#sorteren')
                ->select('sorteren', 'naam')
                ->assertSelected('sorteren', 'naam');
        });
    }
}
