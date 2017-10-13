<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

/**
 * Settings
 * @package Djetson\Shop
 *
 * @property string     $price_format_decimal_count
 * @property string     $price_format_decimal_point
 * @property string     $price_format_thousands_separator
 *
 * @property boolean    $order_allow_payment_total
 * @property boolean    $order_allow_shipping_total
 *
 * @property \Djetson\Shop\Models\Currency  $currency
 * @property \Djetson\Shop\Models\Status    $order_status_new
 *
 * @method static $this instance()
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \System\Behaviors\SettingsModel
 */
class Settings extends Model
{
    use Validation;

    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'djetson_shop_settings';
    public $settingsFields = 'fields.yaml';

    /** Constants */
    const PRICE_FORMAT_DECIMAL_COUNT = 2;
    const PRICE_FORMAT_DECIMAL_POINT = '.';
    const PRICE_FORMAT_THOUSANDS_SEPARATOR = ',';
    const PRICE_FORMAT_POSITION_BEFORE = 'before';
    const PRICE_FORMAT_POSITION_AFTER = 'after';

    /** @var array Relations */
    public $belongsTo = [
        'currency' => [
            'Djetson\Shop\Models\Currency',
        ],
        'order_status_new' => [
            'Djetson\Shop\Models\Status',
        ],
        'import_product_template' => [
            'Djetson\Shop\Models\ImportTemplate',
        ]
    ];

    /** @var array Validation rules */
    public $rules = [
        'currency'          => [],
    ];

    /** Init settings */
    public function initSettingsData()
    {
        /** Price settings */
        $this->price_format_decimal_count = self::PRICE_FORMAT_DECIMAL_COUNT;
        $this->price_format_decimal_point = self::PRICE_FORMAT_DECIMAL_POINT;
        $this->price_format_thousands_separator = self::PRICE_FORMAT_THOUSANDS_SEPARATOR;
    }

    /**
     * Get formatted price
     * @param $price
     * @return string
     */
    public static function getFormattedPrice($price)
    {
        $price = self::formatPrice($price);

        if ($currency = self::instance()->currency) {
            $price = $currency->setCurrencyFormat($price);
        }

        return $price;
    }

    /**
     * Transform price to format
     * @param $price
     * @return string
     */
    public static function formatPrice($price)
    {
        return number_format($price,
            self::get('price_format_decimal_count'),
            self::get('price_format_decimal_point'),
            self::get('price_format_thousands_separator'));
    }
}