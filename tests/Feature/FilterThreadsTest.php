<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('user', ['name' => 'JohnDoe']));

        $threadByJohn = create('thread', ['user_id' => auth()->id()]);

        $threadNotByJohn = create('thread', ['user_id' => create('user')]);

        $this->get(route('threads.index') . '?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create('thread');
        create('reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('thread');
        create('reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = create('thread');

        $response = $this->json('GET', 'threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
