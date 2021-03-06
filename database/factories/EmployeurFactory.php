<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employeur;
use Faker\Generator as Faker;

$factory->define(Employeur::class, function (Faker $faker) {

    return [
        'nomEmployeur' => $faker->word,
        'raisonSociale' => $faker->word,
        'cni' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
