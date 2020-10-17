<?php


use App\Models\Composer;
use App\Models\Composition;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Composition::class, function (Faker $faker) {
    return [
        'title' => ucfirst($faker->unique()->userName),
        'composer_id' => function () {
            return Composer::inRandomOrder()->first()->id;
        },
    ];
});
