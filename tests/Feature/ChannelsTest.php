<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_thread_list()
    {
        $channel = create('channel');

        $threadInChannel = create('thread', ['channel_id' => $channel->id]);

        $threadNotInChannel = create('thread', ['channel_id' => 9999]);

        $this->get('threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
