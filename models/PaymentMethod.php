<?php namespace Djetson\Shop\Models;

use Model;
use Config;
use October\Rain\Database\Traits\Validation;

/**
 * PaymentMethod Model
 * @package Djetson\Shop
 *
 * @property int        $id
 * @property string     $name
 * @property string     $provider
 * @property double     $cost
 * @property boolean    $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\PaymentMethod whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\PaymentMethod whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\PaymentMethod whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\PaymentMethod whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
 *
 * @todo Реализовать правила RULES | FIXED or %
 */
class PaymentMethod extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetson_shop_payment_methods';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'provider',
        'cost',
        'is_active',
    ];

    /**
     * Validation
     */
    public $rules = [
        'name'      => ['required', 'between:1,255'],
        'provider'  => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'between:1,255'],
        'cost'      => ['numeric'],
        'is_active' => ['boolean'],
    ];

    /**
     * Provider list
     * @return array
     */
    public function getProviderOptions()
    {
        $list = [];
        $providers = Config::get('djetson.shop::payments.methods', []);

        foreach ($providers as $key => $val) {
            $list[$key] = $val['name'];
        }

        return $list;
    }
}