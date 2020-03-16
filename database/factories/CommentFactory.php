<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'contenuto' => $faker->sentence,
        'user_id' => \App\User::inRandomOrder()->first()->id,
        'post_id' => \App\Post::inRandomOrder()->first()->id,
        'created_at' => \Carbon\Carbon::now()->subMinutes(mt_rand(0,2000)),
    ];
});
