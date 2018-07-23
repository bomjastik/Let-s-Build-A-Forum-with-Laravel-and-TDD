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
    public function user_can_see_thread()
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
    public function user_can_see_thread_replies()
    {
        $thread = $this->thread;

        $reply = create('reply', ['thread_id' => $thread->id]);

        $this->browse(function (Browser $browser) use ($thread, $reply) {
            $browser->resize(1920, 1080);

            $browser->visit($thread->url())
                ->assertSee($reply->body);
        });
    }

}
