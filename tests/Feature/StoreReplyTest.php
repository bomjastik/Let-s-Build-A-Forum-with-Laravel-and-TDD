<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_can_store_reply()
    {
        $this->signIn();

        $thread = create('thread');
        $reply = make('reply');

        $response = $this->post(route('threads.replies.store', $thread->slug), $reply->toArray());

        $this->get($response->headers->get('location'))
            ->assertSee($reply->body);
    }

    /** @test */
    public function guest_can_not_store_reply()
    {
        $this->post(route('threads.replies.store', 'some-thread'), [])
            ->assertRedirect(route('login'));;
    }

    /** @test */
    public function it_requires_body()
    {
        $this->signIn();

        $thread = create('thread');

        $this->post(route('threads.replies.store', $thread->slug), ['body' => null])
            ->assertSessionHasErrors(['body']);
    }
}
