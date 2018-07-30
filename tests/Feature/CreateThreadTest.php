<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_can_create_thread()
    {
        $this->signIn();

        $this->get(route('threads.create'))
            ->assertOk();

        $thread = make('thread');

        $response = $this->post(route('threads.store'), $thread->toArray());

        $this->get($response->headers->get('location'))
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

    /** @test */
    public function it_requires_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function it_requires_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors(['body']);
    }

    /** @test */
    public function it_requires_existing_channel()
    {
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors(['channel_id']);

        $this->publishThread(['channel_id' => 9999])
            ->assertSessionHasErrors(['channel_id']);

        $this->publishThread(['channel_id' => create('channel')->id])
            ->assertSessionHasNoErrors();
    }

    private function publishThread(array $attributes = [])
    {
        $this->signIn();

        $thread = make('thread', $attributes);

        return $this->post(route('threads.store'), $thread->toArray());
    }
}
