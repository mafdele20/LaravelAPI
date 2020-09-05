<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TypeCompte;
use Faker\Generator as Faker;

$factory->define(TypeCompte::class, function (Faker $faker) {

    return [
        'libelle' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
