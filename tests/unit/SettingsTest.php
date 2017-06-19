<?php namespace Djetson\Shop\Tests\Models;

use Djetson\Shop\Models\Currency;
use Djetson\Shop\Models\Settings;
use PluginTestCase;

/**
 * Class SettingsTest
 * @package Djetson\Shop
 * @mixin \PHPUnit_Framework_TestCase
 */
class SettingsTest extends PluginTestCase
{
    protected $class = 'Djetson\Shop\Models\Setting';

    public function test_convert_price()
    {
        $currency = Currency::create([
            'name' => 'Test Currency 1',
            'code' => 'TST',
            'symbol' => '$',
            'symbol_position' => 'after',
            'symbol_space' => true,
        ]);

        $settings = new Settings;
        $settings->price_format_decimal_count = 2;
        $settings->price_format_decimal_point = '.';
        $settings->price_format_thousands_separator = ',';
        $settings->currency = $currency;

        // Position right with space
        $this->assertEquals('1,000.00 $', $settings->getConvertedPrice($currency, 1000));

        // Position right without space
        $currency->symbol_space = false;
        $this->assertEquals('1,000.00$', $settings->getConvertedPrice($currency, 1000));

        // Position before without space
        $currency->symbol_position = 'before';
        $this->assertEquals('$1,000.00', $settings->getConvertedPrice($currency, 1000));

        // Position before with space
        $currency->symbol_space = true;
        $this->assertEquals('$ 1,000.00', $settings->getConvertedPrice($currency, 1000));
    }
}