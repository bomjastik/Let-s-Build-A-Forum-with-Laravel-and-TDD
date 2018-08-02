<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('thread');
    }

    /** @test */
    public function it_can_return_all_threads()
    {
        $this->get('threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function it_can_return_a_specific_thread()
    {
        $this->get($this->thread->url)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('user', ['name' => 'JohnDoe']));

        $threadByJohn = create('thread', ['user_id' => auth()->id()]);

        $threadNotByJohn = $this->thread;

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

        $threadWithNoReplies = $this->thread;

        $response = $this->json('GET', 'threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
