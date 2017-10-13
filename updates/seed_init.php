<?php namespace Djetson\Shop\Updates;

use Djetson\Shop\Models\Currency;
use Djetson\Shop\Models\Settings;

class SeedInitial extends \October\Rain\Database\Updates\Seeder
{
    public function run()
    {
        // Create Currency
        $currency = Currency::create([
            'name' => 'Гривна',
            'code' => 'GRN',
            'symbol' => 'грн.',
            'position' => 'after',
            'space' => true,
        ]);

        // Set default settings
        $settings = Settings::instance();
        $settings->currency = $currency;
        $settings->save();

        // Seed
        $this->call('Djetson\Shop\Seeders\ProductSeeder');
        $this->call('Djetson\Shop\Seeders\OrderSeeder');
    }
}