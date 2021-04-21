<?php


use equipac\Models\Bolsista;
use Faker\Generator as Faker;

$factory->define(Bolsista::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt("root1234"), // password
        'cpf' => $faker->cpf(false),
        'nivel' => 2,
    ];
});
