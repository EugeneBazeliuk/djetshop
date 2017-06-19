<?php namespace Djetson\Shop\Updates;

use Djetson\Shop\Models\PaymentMethod;
use Seeder;
use Djetson\Shop\Models\Currency;
use Djetson\Shop\Models\Settings;
use Djetson\Shop\Models\ShippingMethod;

class SeedInitial extends Seeder
{
    public function run()
    {
        //
        // Add currency
        //
        $currency = Currency::create([
            'name' => 'Us Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'symbol_position' => 'after',
            'symbol_space' => true,
        ]);

        //
        // Add shipping method
        //
        ShippingMethod::create([
            'name' => 'Самовывоз',
            'provider' => 'self',
            'is_active' => true,
        ]);

        //
        //
        //
        PaymentMethod::create([
            'name' => 'Тест',
            'provider' => 'self',
            'is_active' => true,
        ]);

        $settings = Settings::instance();
        $settings->currency = $currency;
        $settings->save();
    }
}