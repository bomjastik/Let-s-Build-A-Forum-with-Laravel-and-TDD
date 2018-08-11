<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorized_users_thread_can_delete_threads()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create('thread', ['user_id' => auth()->id()]);

        $reply = create('reply', ['thread_id' => $thread->id]);

        $response = $this->delete(route('threads.destroy', $thread->slug));

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $response->assertRedirect(route('threads.index'));
    }

    /** @test */
    public function unauthorized_users_can_not_delete_threads()
    {
        $thread = create('thread');

        $this->delete(route('threads.destroy', $thread->slug))
            ->assertRedirect(route('login'));

        $this->signIn();

        $this->delete(route('threads.destroy', $thread->slug))
            ->assertStatus(403);
    }
}
