<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_may_create_new_forum_threads()
    {
        $thread = factory(Thread::class)->make();

        $this->actingAs(factory(User::class)->create())
            ->post(route('threads.store'), $thread->only(['title', 'body']));

        $this->get('/threads/1')
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function guest_may_not_create_new_forum_threads()
    {
        $thread = factory(Thread::class)->make();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('threads.store'), $thread->only(['title', 'body']));
    }
}
