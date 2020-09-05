<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Operation;
use Faker\Generator as Faker;

$factory->define(Operation::class, function (Faker $faker) {

    return [
        'taxe' => $faker->word,
        'montant' => $faker->word,
        'dateOperation' => $faker->word,
        'type_operation' => $faker->word,
        'compte_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
