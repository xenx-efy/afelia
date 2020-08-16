<?php

use App\Model;
use App\Models\Composer;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Composer::class, function (Faker $faker) {
    return [
        'composer_name' => $faker->lastName . ' ' . $faker->firstName
    ];
});
