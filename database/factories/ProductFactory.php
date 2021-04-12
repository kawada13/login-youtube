<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->name,
        'price' => $faker->numberBetween(10,100),
        'category_id' => factory(App\Category::class),
    ];
});
