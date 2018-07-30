<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_body()
    {
        $reply = create('reply', ['body' => 'Test body']);

        $this->assertSame('Test body', $reply->body);
    }

    /** @test */
    public function it_has_an_owner()
    {
        $user = create('user');

        $reply = create('reply', ['user_id' => $user->id]);

        $this->assertTrue($user->replies->contains($reply));
    }

    /** @test */
    public function it_belongs_to_a_thread()
    {
        $thread = create('thread');

        $reply = create('reply', ['thread_id' => $thread->id]);

        $this->assertTrue($thread->replies->contains($reply));
    }
}
