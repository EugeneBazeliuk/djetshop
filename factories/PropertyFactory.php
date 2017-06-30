<?php

/**
 * Property factory
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define('Djetson\Shop\Models\Property', function (Faker\Generator $faker) {

    $name = $faker->unique()->numerify('Property ###');

    return [
        // Base
        'name' => $name,
        'code' => str_slug($name),
        // Description
        'description' => $faker->realText(255),
        // States
        'is_active' => $faker->boolean(70),
    ];
});

/**
 * PropertyGroup factory
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define('Djetson\Shop\Models\PropertyGroup', function (Faker\Generator $faker) {

    $name = $faker->unique()->numerify('Property group ###');

    return [
        // Base
        'name' => $name,
    ];
});

/**
 * PropertyValue factory
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define('Djetson\Shop\Models\PropertyValue', function (Faker\Generator $faker) {

    $name = $faker->unique()->numerify('Property value ###');

    return [
        // Base
        'value' => $name,
    ];
});