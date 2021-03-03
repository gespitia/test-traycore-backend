<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Persona;
use Faker\Generator as Faker;

$factory->define(Persona::class, function (Faker $faker) {
    return [
        'nombres' => $faker->lastName,
        'apellidos' => $faker->firstName,
        'n_idententidad' => $faker->unique()->numberBetween(433535,2323547),
        'edad' => $faker->numberBetween(18,99),
        'peso' => $faker->numberBetween(10,200),
        'altura' => $faker->numberBetween(0,200),
        'genero' =>$faker->randomElement(['M','F']),
        'fecha_nacimiento'=> $faker->dateTimeBetween('1990-01-01', '2012-12-31')
            ->format('Y-m-d'),
        'planeta_id' => $faker->numberBetween(1,10)
    ];
});
