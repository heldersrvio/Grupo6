<?php


use equipac\Models\Supervisor;
use Faker\Generator as Faker;

$factory->define(Supervisor::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt("root1234"), // password
        'cpf' => $faker->cpf(false),
        'nivel' => 1,
    ];
});
