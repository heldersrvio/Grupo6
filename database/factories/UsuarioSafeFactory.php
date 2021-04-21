<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use equipac\Models\Usuario;
use Faker\Generator as Faker;

$factory->define(Usuario::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt("root1234"), // password
        'cpf' => $faker->cpf(false),
        'nivel' => 3,
    ];
});
