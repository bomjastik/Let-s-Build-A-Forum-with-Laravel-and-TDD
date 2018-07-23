<?php

use App\User;
use App\Thread;
use Faker\Generator as Faker;

$user = User::inRandomOrder()->first();
$thread = Thread::inRandomOrder()->first();

$factory->define(App\Reply::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    $thread = Thread::inRandomOrder()->first();

    return [
        'user_id' => $user ? $user->id : factory(User::class)->create()->id,
        'thread_id' => $thread ? $thread->id : factory(Thread::class)->create()->id,
        'body' => $faker->paragraph
    ];
});
