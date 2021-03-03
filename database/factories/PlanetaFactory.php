<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Planeta;
use Faker\Generator as Faker;

$factory->define(Planeta::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'periodo_rotacion' => $faker->numberBetween(0,10000),
        'diametro' => $faker->numberBetween(0,100000),
        'clima' => $faker->state,
        'terreno' => $faker->streetName,
        'masa' => $faker->numberBetween(100,2000),
        'radio_orbital' => $faker->numberBetween(0,40000)
    ];
});
