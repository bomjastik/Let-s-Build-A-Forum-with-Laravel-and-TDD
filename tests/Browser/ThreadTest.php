<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends DuskTestCase
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
    public function a_user_can_browse_a_specific_thread()
    {
        $thread = $this->thread;

        $this->browse(function (Browser $browser) use ($thread) {
            $browser->resize(1920, 1080);

            $browser->visit($thread->url())
                ->assertSee($thread->title);
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function a_user_can_read_replies_for_the_thread()
    {
        $thread = $this->thread;

        $reply = create('reply', ['thread_id' => $thread->id]);

        $this->browse(function (Browser $browser) use ($thread, $reply) {
            $browser->resize(1920, 1080);

            $browser->visit($thread->url())
                ->assertSee($reply->body);
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function an_authenticated_user_can_see_a_reply_form()
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
    public function unauthenticated_user_can_not_see_a_reply_form()
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
    public function an_authenticated_user_can_submit_a_new_reply()
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
