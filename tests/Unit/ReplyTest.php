<?php

namespace Tests\Unit;

use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    private $reply;

    public function setUp()
    {
        parent::setUp();

        $this->reply = factory(Reply::class)->create([
            'body' => 'Test body'
        ]);
    }

    /** @test */
    public function it_has_a_body()
    {
        $this->assertSame('Test body', $this->reply->body);
    }

    /** @test */
    public function it_has_an_owner()
    {
        $this->assertInstanceOf('App\User', $this->reply->owner);
    }

    /** @test */
    public function it_belongs_to_a_thread()
    {
        $this->assertInstanceOf('App\Thread', $this->reply->thread);
    }
}
