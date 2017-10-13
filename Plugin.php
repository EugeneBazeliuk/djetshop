<?php namespace Djetson\Shop;

use System\Classes\PluginBase;
use Djetson\Shop\Models\Settings;

/**
 * Shop Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     *
     */
    public function registerFormWidgets()
    {
        return [
            'Djetson\Shop\FormWidgets\OrderItems' => 'orderItems',
        ];
    }

    /**
     * Register List Column Types
     * @return array
     */
    public function registerListColumnTypes()
    {
        return [
            'price' => function($value) {
                return Settings::formatPrice($value);
            },
            'label' => [$this, 'evalLabelListColumn'],
            'switch_colored' => [$this, 'evalSwitchColoredListColumn']
        ];
    }

    /**
     * @param $value
     * @param $column
     * @param $record
     *
     * @return string
     */
    public function evalLabelListColumn($value, $column, $record)
    {
        return sprintf('<span class="btn btn-label" style="background: %s">%s</span>', $record->color, $value);
    }

    /**
     * @param $value
     * @return string
     */
    public function evalSwitchColoredListColumn($value)
    {
        return sprintf('<span class="oc-icon-circle %s">', $value ? 'text-success' : 'text-danger');
    }
}