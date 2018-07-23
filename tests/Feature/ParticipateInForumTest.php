<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->make();

        $this->actingAs(factory(User::class)->create());
        $this->post(route('threads.replies.store', $thread->id), ['body' => $reply->body]);

        $this->get($thread->url())
            ->assertSee($reply->body);
    }

    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        $thread = factory(Thread::class)->create();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('threads.replies.store', $thread->id), []);
    }

}
