<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, static function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->unique()->slug(3),
        'poster' => $faker->imageUrl(),
        'description' => $faker->sentence,
        'price' => $faker->randomDigit,
        'category_id' => \App\Models\Category::all()->random(1)->first()->id,
        'brand' => $faker->randomElement(['小米', '华为', 'Apple', 'Nike', 'lenove']),
    ];
});
