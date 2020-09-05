<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TypeOpeartion;
use Faker\Generator as Faker;

$factory->define(TypeOpeartion::class, function (Faker $faker) {

    return [
        'libelle' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
