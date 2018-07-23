<?php

namespace Tests\Unit;

use App\User;
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

        $this->user = factory(User::class)->create();
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
