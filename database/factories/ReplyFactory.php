<?php

use App\User;
use App\Thread;
use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'thread_id' => factory(Thread::class)->create()->id,
        'body' => $faker->paragraph
    ];
});
