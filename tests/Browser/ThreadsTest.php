<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ThreadsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function user_can_see_threads()
    {
        $this->browse(function (Browser $browser) {
            $thread = create('thread');

            $browser->visit('threads')
                ->assertSee($thread->title);
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function user_can_visit_thread()
    {
        $this->browse(function (Browser $browser) {

            $thread = create('thread');

            $browser->visit('threads')
                ->assertSeeLink($thread->title)
                ->clickLink($thread->title)
                ->assertUrlIs($thread->url())
                ->assertSee($thread->title)
                ->assertSee($thread->body);
        });
    }

}
