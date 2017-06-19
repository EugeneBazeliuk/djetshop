<?php namespace Djetson\Shop\Models;

use Model;
use ApplicationException;
use October\Rain\Database\Traits\Validation;

/**
 * Currency Model
 *
 * @property int        $id
 * @property string     $name
 * @property string     $code
 * @property string     $symbol
 * @property string     $symbol_position
 * @property boolean    $symbol_space
 *
 * @mixin   \October\Rain\Database\Model
 * @mixin   \October\Rain\Database\Builder
 * @mixin   \October\Rain\Database\Traits\Validation
 */
class Currency extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetshop_currencies';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'symbol_position',
        'symbol_space',
    ];

    /**
     * Validation
     */
    public $rules = [
        'name'      => ['required', 'between:1,255'],
        'code'      => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'between:1,255', 'unique:djetshop_currencies'],
        'symbol'    => ['required', 'between:1,255'],
        'symbol_space'      => ['boolean'],
        'symbol_position'   => ['required', 'between:1,255'],
    ];

    /**
     * @throws \ApplicationException
     */
    public function beforeDelete()
    {
        if ($this->checkIsDefaultCurrency()) {
            throw new ApplicationException(trans('djetson.shop::lang.currencies.errors.delete_default'));
        }
    }

    /**
     * Get preview attribute
     * @return string
     */
    public function getPreviewAttribute()
    {
        $settings = new Settings;

        return $settings->instance()->convertPrice($this, 100.00);
    }

    /**
     * @return bool
     */
    public function checkIsDefaultCurrency()
    {
        $settings = new Settings;

        if ($this->id == $settings->instance()->currency->id) {
            return true;
        }

        return false;
    }
}