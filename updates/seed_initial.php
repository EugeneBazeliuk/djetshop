<?php namespace Djetson\Shop\Updates;

use Djetson\Shop\Models\Currency;
use Djetson\Shop\Models\PaymentMethod;
use Djetson\Shop\Models\Settings;
use Djetson\Shop\Models\ShippingMethod;
use Seeder;

class SeedInitial extends Seeder
{
    public function run()
    {
        // Create default currency
        $currency = Currency::create([
            'name' => 'Us Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'symbol_position' => 'after',
            'symbol_space' => true,
        ]);

        $settings = new Settings;
        $settings->instance()->set(['currency' => $currency->id]);

        ShippingMethod::create([
            'name' => 'Новая почта',
            'provider' => 'novaposhta',
            'cost' => 35.00,
            'is_active' => true
        ]);

        ShippingMethod::create([
            'name' => 'Укрпочта',
            'provider' => 'ukrposhta',
            'cost' => 35.00,
            'is_active' => true
        ]);

        ShippingMethod::create([
            'name' => 'Самовывоз',
            'provider' => 'self',
            'cost' => 35.00,
            'is_active' => true
        ]);

        PaymentMethod::create([
            'name' => 'Приват24',
            'provider' => 'privatbank',
            'cost' => 35.00,
            'is_active' => true
        ]);
    }
}