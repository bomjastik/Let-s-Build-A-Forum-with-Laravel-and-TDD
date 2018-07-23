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
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->replies);
    }

    /** @test */
    public function it_can_own_threads()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->threads);
    }
}
