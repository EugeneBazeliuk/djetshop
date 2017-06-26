<?php

/**
 * Order Status factory
 * @var $factory \Illuminate\Database\Eloquent\Factory
 */
$factory->define('Djetson\Shop\Models\OrderStatus', function (Faker\Generator $faker) {
    return [
        'name' => $faker->numerify('Order status ###'),
        'color' => $faker->hexcolor,
        'is_active' => $faker->boolean(60),
        'is_send_email' => false,
        'is_attach_invoice' => false,
    ];
});