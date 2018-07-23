<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_return_all_threads()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get('threads');

        $response->assertSee($thread->title);
    }

    /** @test */
    public function it_can_return_a_specific_thread()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get($thread->url());

        $response->assertSee($thread->title);
    }
}
