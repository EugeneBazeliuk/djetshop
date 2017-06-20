<?php namespace Djetson\Shop\Models;

use Model;
use ApplicationException;
use October\Rain\Database\Traits\Validation;

/**
 * Currency Model
 * @package Djetson\Shop
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $symbol
 * @property string $symbol_position
 * @property bool $symbol_space
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $preview
 *
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereSymbolPosition($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereSymbolSpace($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\Currency whereUpdatedAt($value)
 *
 * @mixin   \Eloquent
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
        'code'      => ['required', 'alpha_num', 'size:3', 'unique:djetshop_currencies'],
        'symbol'    => ['required', 'between:1,255'],
        'symbol_space'      => ['boolean'],
        'symbol_position'   => ['required', 'between:1,255'],
    ];

    /**
     * @throws \ApplicationException
     */
    public function beforeDelete()
    {
        if (Settings::instance()->checkIsDefaultCurrency($this->id)) {
            throw new ApplicationException(trans('djetson.shop::lang.currencies.errors.delete_default'));
        }
    }

    /**
     * Get preview attribute
     * @return string
     */
    public function getPreviewAttribute()
    {
        return Settings::instance()->getConvertedPrice($this, 100.00);
    }
}