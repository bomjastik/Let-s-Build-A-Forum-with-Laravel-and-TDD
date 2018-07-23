<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
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
        $this->get($this->thread->url())
            ->assertSee($this->thread->title);
    }
}
