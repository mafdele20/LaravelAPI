<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {

    return [
        'nom' => $faker->word,
        'prenom' => $faker->word,
        'adresse' => $faker->word,
        'email' => $faker->word,
        'telephone' => $faker->randomDigitNotNull,
        'salaire' => $faker->word,
        'nomEntreprise' => $faker->word,
        'typeclient' => $faker->word,
        'employeur_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
