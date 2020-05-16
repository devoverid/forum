<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Discussion;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Discussion::class, function (Faker $faker) {
    $title = $faker->text(100);
    return [
        'user_id' => rand(1, 4),
        'title' => $title,
        'slug' => Str::slug($title, '-'),
        'content' => $faker->text(10000),
    ];
});
