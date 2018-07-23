<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();

    return [
        'user_id' => $user ? $user->id : factory(User::class)->create()->id,
        'title' => $faker->sentence,
        'body' => $faker->paragraph(10),
    ];
});
