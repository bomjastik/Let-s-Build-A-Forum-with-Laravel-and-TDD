<?php

namespace Tests\Unit;

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

        $this->thread = create('thread', [
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
    public function it_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    public function it_can_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function it_can_add_a_reply()
    {
        $this->thread->replies()->create([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
