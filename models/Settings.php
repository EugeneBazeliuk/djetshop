<?php namespace Djetson\Shop\Models;

use Model;
use ApplicationException;

/**
 * Settings
 * Manage plugin settings
 *
 * @property    \Djetson\Shop\Models\Currency $currency
 * @method      \October\Rain\Database\Relations\BelongsTo currency
 *
 * @property string $price_format_decimal_count
 * @property string $price_format_decimal_point
 * @property string $price_thousands_separator
 *
 * @method static get($key, $value)
 * @method static set($key, $value)
 *
 * @mixin \October\Rain\Database\Model
 * @mixin \System\Behaviors\SettingsModel
 *
 * @package Djetson\Shop
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'djetshop_settings';
    public $settingsFields = 'fields.yaml';

    //
    // CONSTANTS
    //
    const PRICE_FORMAT_DECIMAL_COUNT = 2;
    const PRICE_FORMAT_DECIMAL_POINT = '.';
    const PRICE_FORMAT_THOUSANDS_SEPARATOR = ',';
    const PRICE_FORMAT_POSITION_BEFORE = 'before';
    const PRICE_FORMAT_POSITION_AFTER = 'after';

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'currency' => [
            'Djetson\Shop\Models\Currency',
        ],
    ];

    public function initSettingsData()
    {
        $this->price_format_decimal_count = self::PRICE_FORMAT_DECIMAL_COUNT;
        $this->price_format_decimal_point = self::PRICE_FORMAT_DECIMAL_POINT;
        $this->price_thousands_separator = self::PRICE_FORMAT_THOUSANDS_SEPARATOR;
    }

    /**
     * Convert float price to default currency format
     * @param float $price
     *
     * @return string
     */
    public function getPriceFormat(float $price)
    {
        return $this->convertPrice($this->getDefaultCurrency(), $price);
    }

    /**
     * Convert float price to currency format
     * @param \Djetson\Shop\Models\Currency $currency
     * @param float $price
     *
     * @return string
     * @throws \ApplicationException
     */
    public function convertPrice(Currency $currency, float $price)
    {
        $price = number_format($price, $this->price_format_decimal_count, $this->price_format_decimal_point, $this->price_thousands_separator);
        $space = $currency->symbol_space ? ' ' : '';

        switch ($currency->symbol_position)
        {
            case self::PRICE_FORMAT_POSITION_AFTER:
                $price = implode($space, [$price, $currency->symbol]);
                break;
            case self::PRICE_FORMAT_POSITION_BEFORE:
                $price = implode($space, [$currency->symbol, $price]);
                break;
            default:
                throw new ApplicationException('Wrong price format position');
        }

        return (string) $price;
    }

    /**
     * Get default currency
     * @return \Djetson\Shop\Models\Currency
     * @throws \ApplicationException
     */
    public function getDefaultCurrency()
    {
        if (!$this->currency) {
            throw new ApplicationException(trans('djetson.shop::lang.settings.errors.currency_failed'));
        }

        return $this->currency;
    }
}