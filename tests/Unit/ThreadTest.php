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
        $this->assertSame(url("/threads/{$this->thread->channel->slug}/{$this->thread->slug}"), $this->thread->url);
    }

    /** @test */
    public function it_has_a_creator()
    {
        $user = create('user');

        $thread = create('thread', ['user_id' => $user->id]);

        $this->assertTrue($user->threads->contains($thread));
    }

    /** @test */
    public function it_can_has_replies()
    {
        $reply = create('reply', ['thread_id' => $this->thread->id]);

        $this->assertTrue($this->thread->replies->contains($reply));
    }

    /** @test */
    public function it_can_add_a_reply()
    {
        $reply = $this->thread->replies()->create(raw('reply'));

        $this->assertSame($this->thread->replies->first()->id, $reply->id);
    }

    /** @test */
    public function it_can_belong_to_chanel()
    {
        $channel = create('channel');

        $channel->threads()->save($this->thread);

        $this->assertTrue($channel->threads->contains($this->thread));
    }
}
