<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id'=>\App\Models\Category::all()->random()->id,
        'title'=>$faker->unique()->text(100),
        'description'=>$faker->realText(),
        'price'=>random_int(100, 1000),
    ];
});
