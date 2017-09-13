<?php namespace Djetson\Shop\Updates;

use App;
use Seeder;
use Djetson\Shop\Models\Currency;
use Djetson\Shop\Models\Settings;

class SeedInitial extends Seeder
{
    public function run()
    {
        // Register factories
        App::register('Djetson\Shop\Providers\FactoryServiceProvider');

        // Create Currency
        $currency = Currency::create([
            'name' => 'Гривна',
            'code' => 'GRN',
            'symbol' => 'грн.',
            'symbol_position' => 'after',
            'symbol_space' => true,
        ]);

        // Set default settings
        $settings = Settings::instance();
        $settings->currency = $currency;
        $settings->save();

        // Test seed
        factory('Djetson\Shop\Models\Product', 5)->create();
        factory('Djetson\Shop\Models\Category', 2)->create();
        factory('Djetson\Shop\Models\Manufacturer', 2)->create();
        factory('Djetson\Shop\Models\Status', 2)->create();
    }
}