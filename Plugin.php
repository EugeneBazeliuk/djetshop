<?php namespace Djetson\Shop;

use System\Classes\PluginBase;
use Djetson\Shop\Models\Settings;

/**
 * Shop Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Register List Column Types
     * @return array
     */
    public function registerListColumnTypes()
    {
        return [
            'price' => function(float $value) {
                return Settings::instance()->convertPrice($value);
            }
        ];
    }
}