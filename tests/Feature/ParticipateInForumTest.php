<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $thread = create('thread');

        $reply = make('reply');

        $this->signIn();

        $this->post(route('threads.replies.store', $thread->id), ['body' => $reply->body]);

        $this->get($thread->url())
            ->assertSee($reply->body);
    }

    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('threads.replies.store', create('thread')->id), []);
    }

}
