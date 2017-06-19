<?php namespace Djetson\Shop\Models;

use Model;
use ApplicationException;

/**
 * Settings
 * @package Djetson\Shop
 *
 * @property string $price_format_decimal_count
 * @property string $price_format_decimal_point
 * @property string $price_format_thousands_separator
 * @property \Djetson\Shop\Models\Currency $currency
 *
 * @method \October\Rain\Database\Relations\BelongsTo currency
 *
 * @see \System\Behaviors\SettingsModel::instance()
 * @see \System\Behaviors\SettingsModel::set()
 * @see \System\Behaviors\SettingsModel::get()
 *
 * @mixin \October\Rain\Database\Model
 * @mixin \System\Behaviors\SettingsModel
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'djetson_shop_settings';
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
        $this->price_format_thousands_separator = self::PRICE_FORMAT_THOUSANDS_SEPARATOR;
    }

    /**
     * Convert float price to default currency format
     * @param float $price
     *
     * @return string
     */
    public function convertPrice(float $price)
    {
        return $this->getConvertedPrice($this->getDefaultCurrency(), $price);
    }

    /**
     * Convert float price to currency format
     * @param \Djetson\Shop\Models\Currency $currency
     * @param float $price
     *
     * @return string
     * @throws \ApplicationException
     */
    public function getConvertedPrice(Currency $currency, float $price)
    {
        $space = $currency->symbol_space ? ' ' : '';
        $price = number_format($price,
            $this->price_format_decimal_count,
            $this->price_format_decimal_point,
            $this->price_format_thousands_separator);

        switch ($currency->symbol_position) {
            case self::PRICE_FORMAT_POSITION_BEFORE;
                $price = implode($space, [$currency->symbol, $price]);
                break;
            case self::PRICE_FORMAT_POSITION_AFTER;
                $price = implode($space, [$price, $currency->symbol]);
                break;
            default:
                throw new ApplicationException(trans('djetson.shop::lang.settings.errors.failed_price_format_position'));
        }

        return (string) $price;
    }

    /**
     * Get default currency
     * @return \Djetson\Shop\Models\Currency
     * @throws \ApplicationException
     */
    private function getDefaultCurrency()
    {
        if ($this->currency) {
            return $this->currency;
        }

        throw new ApplicationException(trans('djetson.shop::lang.settings.errors.failed_default_currency'));
    }
}