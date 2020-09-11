<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Movie;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence(3, true),
        'description' => $faker->paragraph,
        'rating'      => $faker->numberBetween(0, 5),
        'image_url'   => $faker->imageUrl(),
    ];
});
