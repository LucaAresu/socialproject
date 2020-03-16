<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'titolo' => $faker->sentence,
        'contenuto' => $faker->text(500),
        'user_id' => \App\User::inRandomOrder()->first()->id,
        'created_at' => \Carbon\Carbon::now()->subMinutes(mt_rand(0,2000)),

    ];
});
