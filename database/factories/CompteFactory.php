<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Compte;
use Faker\Generator as Faker;

$factory->define(Compte::class, function (Faker $faker) {

    return [
        'numero' => $faker->word,
        'cleRib' => $faker->word,
        'date' => $faker->word,
        'etat' => $faker->word,
        'solde' => $faker->word,
        'frais' => $faker->word,
        'type_compte_id' => $faker->word,
        'client_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
