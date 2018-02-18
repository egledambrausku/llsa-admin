<?php

$factory->define(App\Competition::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "date" => $faker->date("Y-m-d", $max = 'now'),
    ];
});
