<?php

namespace Tests\Unit;

use App\Reply;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_has_replies()
    {
        $user = factory(User::class)->create();

        $replies = factory(Reply::class, 3)->create([
            'user_id' => $user->id
        ]);

        $this->assertCount(3, $replies);
    }
}
