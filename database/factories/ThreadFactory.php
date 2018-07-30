<?php

use App\Channel;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    $channel = Channel::inRandomOrder()->first();
    $title = $faker->sentence;

    return [
        'user_id' => $user ? $user->id : factory(User::class)->create()->id,
        'channel_id' => $channel ? $channel->id : factory(Channel::class)->create()->id,
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->paragraph(10),
    ];
});
