<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {

    $created = $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-1 months', $timezone = config('app.timezone'));
    return [
        'name' => $faker->unique()->domainWord,
        'price' => $faker->randomFloat(2,5,3000),
        'quantity' => $faker->numberBetween(0,120),
        'created_at'=> $created,
        'updated_at'=> $faker->dateTimeBetween($startDate = $created, $endDate = 'now', $timezone = config('app.timezone'))
    ];
});