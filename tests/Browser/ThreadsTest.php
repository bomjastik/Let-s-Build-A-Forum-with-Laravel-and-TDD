<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends DuskTestCase
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
    public function user_can_see_threads()
    {
        $thread = $this->thread;

        $this->browse(function (Browser $browser) use ($thread) {
            $browser->resize(1920, 1080);

            $browser->visit('threads')
                ->assertSee($thread->title);
        });
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

            $browser->visit('threads')
                ->assertSeeLink($thread->title)
                ->clickLink($thread->title)
                ->assertUrlIs($thread->url())
                ->assertSee($thread->title)
                ->assertSee($thread->body);
        });
    }

}
