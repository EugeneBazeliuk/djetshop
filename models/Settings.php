<?php namespace Djetson\Shop\Models;

use ApplicationException;
use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

/**
 * Settings
 * @package Djetson\Shop
 *
 * @property string     $price_format_decimal_count
 * @property string     $price_format_decimal_point
 * @property string     $price_format_thousands_separator
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
        'currency'          => ['required'],
    ];

    /**
     * Init settings
     */
    public function initSettingsData()
    {
        $this->price_format_decimal_count = self::PRICE_FORMAT_DECIMAL_COUNT;
        $this->price_format_decimal_point = self::PRICE_FORMAT_DECIMAL_POINT;
        $this->price_format_thousands_separator = self::PRICE_FORMAT_THOUSANDS_SEPARATOR;
    }

    /**
     * Format price
     * @param float $price
     * @param null|Currency $currency
     * @return string
     * @throws ApplicationException
     */
    public static function formatPrice(float $price, Currency $currency = null)
    {
        if (!$currency) {
            $currency = self::getDefaultCurrency();
        }

        $space = $currency->symbol_space ? ' ' : '';
        $price = number_format($price,
            self::get('price_format_decimal_count'),
            self::get('price_format_decimal_point'),
            self::get('price_format_thousands_separator'));


        switch ($currency->symbol_position) {
            case self::PRICE_FORMAT_POSITION_BEFORE;
                $price = implode($space, [$currency->symbol, $price]);
                break;
            case self::PRICE_FORMAT_POSITION_AFTER;
                $price = implode($space, [$price, $currency->symbol]);
                break;
            default:
                throw new ApplicationException(trans('djetson.shop::lang.errors.failed_price_format_position'));
        }

        return (string) $price;
    }

    /**
     * Get default currency
     * @return Currency
     * @throws ApplicationException
     */
    public static function getDefaultCurrency()
    {
        if ($currency = self::instance()->currency) {
            return $currency;
        }

        throw new ApplicationException(trans('djetson.shop::lang.errors.failed_get_default_currency'));
    }

    /**
     * Check default currency
     * @param Currency $currency
     * @return bool
     */
    public static function isDefaultCurrency(Currency $currency)
    {
        if ($currency->id == self::get('currency_id')) {
            return true;
        } else {
            return false;
        }
    }
}