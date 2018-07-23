<?php

namespace Tests\Unit;

use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_body()
    {
        $reply = factory(Reply::class)->create(['body' => 'Test body']);

        $this->assertSame('Test body', $reply->body);
    }

    /** @test */
    public function it_has_an_owner()
    {
        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf('App\User', $reply->owner);
    }

    /** @test */
    public function it_belongs_to_a_thread()
    {
        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf('App\Thread', $reply->thread);
    }
}
