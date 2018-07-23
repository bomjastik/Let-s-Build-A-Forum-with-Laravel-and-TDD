<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_may_create_new_forum_threads()
    {
        $thread = make('thread');

        $this->signIn();

        $this->post(route('threads.store'), $thread->only(['title', 'body']));

        $this->get('/threads/1')
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function guest_may_not_create_new_forum_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('threads.store'), make('thread')->only(['title', 'body']));
    }
}
