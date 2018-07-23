<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function auth_can_create_thread()
    {
        $this->signIn();

        $this->get(route('threads.create'))
            ->assertOk();
    }

    /** @test */
    public function guest_can_not_create()
    {
        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function auth_can_store_thread()
    {
        $this->signIn();

        $this->post(route('threads.store'), raw('thread'));

        $thread = Thread::first();

        $this->get($thread->url())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function guest_can_not_store_thread()
    {
        $this->post(route('threads.store'), raw('thread'))
            ->assertRedirect(route('login'));
    }
}
