<?php namespace Djetson\Shop\Models;

use Model;
use Config;
use October\Rain\Database\Traits\Validation;

/**
 * ShippingMethod Model
 * @package Djetson\Shop
 *
 * @property int        $id
 * @property string     $name
 * @property string     $provider
 * @property double     $cost
 * @property boolean    $is_active
 * @property float $free_shipping_limit
 * @property bool $is_allow_in_order
 * @property bool $is_allow_free_shipping
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereFreeShippingLimit($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereIsAllowFreeShipping($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereIsAllowInOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\ShippingMethod whereUpdatedAt($value)
 *
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
 */
class ShippingMethod extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetshop_shipping_methods';

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
        'settings',
        'cost',
        'free_rule_value',
        'is_free_rule',
        'is_active',
    ];

    /**
     * @var array Json fields
     */
    protected $jsonable  = ['settings'];

    /**
     * Validation
     */
    public $rules = [
        'name'      => ['required', 'between:1,255'],
        'provider'  => ['required', 'alpha_dash', 'between:1,255'],
        'cost'      => ['required_if:is_allow_in_order,1', 'numeric'],
        'free_shipping_limit'   => ['required_if:is_free_shipping,1', 'numeric'],
        'is_allow_in_order'         => ['boolean'],
        'is_allow_free_shipping'    => ['boolean'],
        'is_active'                 => ['boolean'],
    ];

    /**
     * Provider list
     * @return array
     */
    public function getProviderOptions()
    {
        $list = [];

        foreach (Config::get('djetson.shop::shipping.methods', []) as $key => $val) {
            $list[$key] = $val['name'];
        }

        return $list;
    }

    /**
     * Form filter
     * @param $fields
     * @param null $context
     */
    public function filterFields($fields, $context = null)
    {
        // Filter for cost field
        if ($this->is_allow_in_order == false) {
            $fields->cost->value = 0;
        }
    }
}