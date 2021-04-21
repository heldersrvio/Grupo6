<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use equipac\models\Equipamento;
use Faker\Generator as Faker;

$factory->define(Equipamento::class, function (Faker $faker) {
    return [
        'patrimonio' => $faker->randomNumber(6),
        'modelo' => $faker->company,
    ];
});
