<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create('user');
    }

    /** @test */
    public function it_can_own_replies()
    {
        $reply = create('reply', ['user_id' => $this->user->id]);

        $this->assertTrue($this->user->replies->contains($reply));
    }

    /** @test */
    public function it_can_own_threads()
    {
        $thread = create('thread', ['user_id' => $this->user->id]);

        $this->assertTrue($this->user->threads->contains($thread));
    }
}
