<?php

use Faker\Generator as Faker;

$factory->define(App\Staff::class, function (Faker $faker) {

    return [
        'position_id' => $faker->numberBetween(7,71),
        'name' => $faker->name,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'employed_at' => mt_rand(2012,2017).'-'.mt_rand(1,12).'-'.mt_rand(1,28),
        'salary' => $faker->numberBetween(5,20)*100
    ];
});
