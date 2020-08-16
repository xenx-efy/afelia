<?php


use App\Model;
use App\Models\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Tag::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->colorName,
    ];
});
