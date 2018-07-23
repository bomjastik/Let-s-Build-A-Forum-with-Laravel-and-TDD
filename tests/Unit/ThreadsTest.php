<?php

namespace Tests\Unit;

use App\Reply;
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

        $this->thread = factory(Thread::class)->create([
            'title' => 'Test title',
            'body' => 'Test body'
        ]);
    }

    /** @test */
    public function it_has_a_title()
    {
        $this->assertSame('Test title', $this->thread->title);
    }

    /** @test */
    public function it_has_a_body()
    {
        $this->assertSame('Test body', $this->thread->body);
    }

    /** @test */
    public function it_can_has_replies()
    {
        $this->thread->replies()->saveMany(
            factory(Reply::class, 2)->make()
        );

        $this->assertCount(2, $this->thread->replies);

        $this->thread->replies()->save(
            factory(Reply::class)->make()
        );

        $this->assertCount(3, $this->thread->fresh()->replies);
    }
}
