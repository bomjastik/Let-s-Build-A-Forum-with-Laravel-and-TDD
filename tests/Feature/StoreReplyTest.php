<?php

namespace Tests\Feature;

use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auth_can_store_reply()
    {
        $thread = create('thread');

        $this->signIn();

        $this->post(route('threads.replies.store', $thread->id), raw('reply'));

        $reply = Reply::first();

        $this->get($thread->url())
            ->assertSee($reply->body);
    }

    /** @test */
    public function guest_can_not_store_reply()
    {
        $this->post(route('threads.replies.store', create('thread')->id), [])
            ->assertRedirect(route('login'));;
    }

}
