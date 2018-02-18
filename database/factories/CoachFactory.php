<?php

$factory->define(App\Coach::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "club_id" => factory('App\Club')->create(),
    ];
});
