<?php

/**
 * Manufacturer factory
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define('Djetson\Shop\Models\Manufacturer', function (Faker\Generator $faker) {

    $name = $faker->name;

    return [
        // base
        'name' => $name,
        'slug' => str_slug($name),
        // description
        'meta_title' => $faker->realText(255),
        'meta_keywords' => $faker->realText(255),
        'meta_description' => $faker->realText(255),
        'description' => $faker->realText(250, 2),
        // states
        'is_active' => $faker->boolean,
        'is_searchable' => $faker->boolean,
    ];
});