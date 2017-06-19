<?php

/**
 * Account factory
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define('Djetson\Shop\Models\Product', function (Faker\Generator $faker) {

    $name = $faker->name;

    return [
        // base
        'name' => $name,
        'slug' => str_slug($name),
        'sku' => $faker->ean8,
        'ean_13' => $faker->ean13,
        'isbn' => $faker->isbn13,
        // description
        'meta_title' => $faker->realText(255),
        'meta_keywords' => $faker->realText(255),
        'meta_description' => $faker->realText(255),
        'description' => $faker->realText(250, 2),
        // price
        'price' => $faker->randomNumber(2),
        // package
        'package_width' => $faker->randomNumber(1),
        'package_height' => $faker->randomNumber(1),
        'package_depth' => $faker->randomNumber(1),
        'package_weight' => $faker->randomNumber(1),
        // states
        'is_active' => $faker->boolean,
        'is_searchable' => $faker->boolean,
        'is_unique_text' => $faker->boolean,
    ];
});