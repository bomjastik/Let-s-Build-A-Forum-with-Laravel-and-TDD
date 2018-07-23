<?php

namespace Tests\Browser;

use App\Reply;
use App\Thread;
use App\User;
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

        $this->thread = factory(Thread::class)->create();
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

        $reply = factory(Reply::class)->create(['thread_id' => $thread->id]);

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
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);

            $thread = factory(Thread::class)->create();

            $browser->loginAs(factory(User::class)->create())
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
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);

            $thread = factory(Thread::class)->create();

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
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);

            $thread = factory(Thread::class)->create();

            $browser->loginAs(factory(User::class)->create())
                ->visit($thread->url())
                ->type('@reply-body', 'Test reply')
                ->press('@add-reply')
                ->assertSee('Test reply');
        });
    }
}
