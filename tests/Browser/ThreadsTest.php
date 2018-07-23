<?php

namespace Tests\Browser;

use App\Thread;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function a_user_can_browse_threads()
    {
        $thread = factory(Thread::class)->create();

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
    public function a_user_can_browse_a_specific_thread()
    {
        $thread = factory(Thread::class)->create();

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
    public function a_user_can_click_thread_title_on_the_threads_list()
    {
        $thread = factory(Thread::class)->create();

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
