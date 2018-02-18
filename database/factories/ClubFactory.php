<?php

$factory->define(App\Club::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
