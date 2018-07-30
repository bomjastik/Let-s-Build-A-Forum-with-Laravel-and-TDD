<?php

namespace Tests\Browser;

use App\Thread;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function auth_can_create_thread()
    {
        $this->browse(function (Browser $browser) {
            $channel = create('channel');
            $newThread = make('thread');

            $browser->loginAs(create('user'))
                ->visit(route('threads.create'))
                ->type('#title', $newThread->title)
                ->select('#channel_id', $channel->id)
                ->type('#body', $newThread->body)
                ->press('#submit');

            $thread = Thread::first();

            $browser->assertUrlIs($thread->url)
                ->assertSee($thread->title)
                ->assertSee($thread->body);
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_can_not_create_thread()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('threads.create'))
                ->assertRouteIs('login');
        });
    }
}
