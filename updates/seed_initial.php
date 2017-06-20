<?php namespace Djetson\Shop\Updates;

use Djetson\Shop\Models\OrderStatus;
use Seeder;
use Djetson\Shop\Models\Currency;
use Djetson\Shop\Models\ShippingMethod;
use Djetson\Shop\Models\PaymentMethod;

class SeedInitial extends Seeder
{
    public function run()
    {
        // Add currency
        Currency::create([
            'name' => 'Us Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'symbol_position' => 'after',
            'symbol_space' => true,
        ]);

        // Add shipping method
        ShippingMethod::create([
            'name' => 'Самовывоз',
            'provider' => 'self',
            'is_active' => true,
        ]);

        // Add Payment method
        PaymentMethod::create([
            'name' => 'Тестовый метод оплаты',
            'provider' => 'self',
            'is_active' => true,
        ]);

        // Add Order status
        OrderStatus::create([
            'name' => 'Тестовый метод оплаты',
            'color' => '#1abc9c',
            'is_active' => true,
        ]);
    }
}