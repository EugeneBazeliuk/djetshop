<?php

/**
 * Order Item factory
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define('Djetson\Shop\Models\OrderItem', function (Faker\Generator $faker) {
    return [
        'price' => $faker->randomNumber(2),
        'quantity' => $faker->randomNumber(1),
    ];
});