<?php

namespace Tests\Unit;

use App\Activity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_record_activity_when_the_thread_is_created()
    {
        $this->signIn();

        $thread = create('thread');

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread),
        ]);

        $activity = Activity::first();

        $this->assertSame($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_record_activity_when_the_reply_is_created()
    {
        $this->signIn();

        create('reply');

        $this->assertCount(2, Activity::all());
    }
}
