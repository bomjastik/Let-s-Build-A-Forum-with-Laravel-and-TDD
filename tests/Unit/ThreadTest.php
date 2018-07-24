<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('thread', [
            'title' => 'Test title',
            'slug' => str_slug('Test title'),
            'body' => 'Test body',
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
    public function it_has_a_slug()
    {
        $this->assertSame(str_slug('Test title'), $this->thread->slug);
    }

    /** @test */
    public function it_has_a_url()
    {
        $this->assertSame(url("/threads/{$this->thread->channel->slug}/{$this->thread->slug}"), $this->thread->url());
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
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function it_can_belong_to_chanel()
    {
        $this->assertInstanceOf('App\Channel', $this->thread->channel);
    }
}
