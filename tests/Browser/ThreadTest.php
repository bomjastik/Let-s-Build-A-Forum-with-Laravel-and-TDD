<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ThreadTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function user_can_see_thread_page()
    {
        $this->browse(function (Browser $browser) {
            $thread = create('thread');
            $reply = create('reply', ['thread_id' => $thread->id]);

            $browser->visit($thread->url)
                ->assertSee($thread->title)
                ->assertSee($thread->body)
                ->assertSee($reply->body);
        });
    }
}
