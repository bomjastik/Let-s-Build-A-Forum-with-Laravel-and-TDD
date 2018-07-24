<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_can_create_thread()
    {
        $this->signIn();

        $this->get(route('threads.create'))
            ->assertOk();

        $this->post(route('threads.store'), raw('thread'));

        $thread = Thread::first();

        $this->get($thread->url())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function guest_can_not_create_thread()
    {
        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));

        $this->post(route('threads.store'), raw('thread'))
            ->assertRedirect(route('login'));
    }
}
