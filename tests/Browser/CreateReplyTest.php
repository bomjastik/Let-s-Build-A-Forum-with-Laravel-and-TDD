<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateReplyTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('thread');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function auth_can_see_a_reply_form()
    {
        $thread = $this->thread;

        $this->browse(function (Browser $browser) use ($thread) {
            $browser->resize(1920, 1080);

            $browser->loginAs(create('user'))
                ->visit($thread->url())
                ->assertVisible('@reply-form');
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_can_not_see_a_reply_form()
    {
        $thread = $this->thread;

        $this->browse(function (Browser $browser) use ($thread) {
            $browser->resize(1920, 1080);

            $browser->visit($thread->url())
                ->assertMissing('@reply-form')
                ->assertVisible('@login-alert');
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function auth_can_submit_a_new_reply()
    {
        $thread = $this->thread;

        $this->browse(function (Browser $browser) use ($thread) {
            $browser->resize(1920, 1080);

            $browser->loginAs(create('user'))
                ->visit($thread->url())
                ->type('@reply-body', 'Test reply')
                ->press('@add-reply')
                ->assertSee('Test reply');
        });
    }
}
