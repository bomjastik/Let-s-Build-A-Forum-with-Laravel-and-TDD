<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_favorite_anything()
    {
        $this->post('replies/1/favorites')
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function auth_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('reply');

        $this->post(route('replies.favorites', $reply->id));

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function auth_may_only_favorite_once()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $reply = create('reply');

        try {
            $this->post(route('replies.favorites', $reply->id));
            $this->post(route('replies.favorites', $reply->id));
        } catch (\Exception $exception) {
            $this->fail('Did not expect to favorite the same record twice');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
