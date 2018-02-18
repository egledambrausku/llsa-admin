<?php

$factory->define(App\Kid::class, function (Faker\Generator $faker) {
    return [
        "first_name" => $faker->name,
        "last_name" => $faker->name,
        "year" => $faker->name,
        "sex" => collect(["0","1",])->random(),
        "group_id" => factory('App\Group')->create(),
        "licence" => 0,
        "coach_id" => factory('App\Coach')->create(),
        "club_id" => factory('App\Club')->create(),
    ];
});
