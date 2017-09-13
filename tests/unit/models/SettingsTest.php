<?php namespace Djetson\Shop\Tests\Unit\Models;

use Djetson\Shop\Models\Settings;
use PluginTestCase;

/**
 * Class SettingsTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class SettingsTest extends PluginTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
    }

    public function test_convert_price()
    {
        $settings = Settings::make([
            'price_format_decimal_count' => 2,
            'price_format_decimal_point' => '.',
            'price_format_thousands_separator' => ',',
        ]);

        $currency = factory('Djetson\Shop\Models\Currency')->create([
            'code' => 'TST',
            'symbol' => '$',
            'symbol_position' => 'before',
            'symbol_space' => true,
        ]);

        // Position left with space
        $this->assertEquals('$ 1,000.00', $settings->formatPrice(1000, $currency));

        // Position left without space
        $currency->symbol_space = false;
        $this->assertEquals('$1,000.00', $settings->formatPrice(1000, $currency));

        // Position right without space
        $currency->symbol_position = 'after';
        $this->assertEquals('1,000.00$', $settings->formatPrice(1000, $currency));

        // Position right with space
        $currency->symbol_space = true;
        $this->assertEquals('1,000.00 $', $settings->formatPrice(1000, $currency));
    }
}