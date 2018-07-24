<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateReplyTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_can_not_create_reply()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(create('thread')->url())
                ->assertMissing('#reply-form')
                ->assertVisible('#login-alert');
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function auth_can_create_reply()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(create('user'))
                ->visit(create('thread')->url())
                ->assertVisible('#reply-form')
                ->type('#body', 'Test reply')
                ->press('#submit')
                ->assertSee('Test reply');
        });
    }
}
