<?php namespace Djetson\Shop\Models;

use Model;
use Config;
use ApplicationException;
use October\Rain\Database\Traits\Validation;

/**
 * PaymentMethod Model
 *
 * @property int        $id
 * @property string     $name
 * @property string     $provider
 * @property double     $cost
 * @property boolean    $is_active
 *
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
     * Before Save action
     */
    public function beforeSave()
    {
        $this->checkProvider();
    }

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

    /**
     * Check provider
     * @throws \ApplicationException
     */
    public function checkProvider()
    {
        $providerList = Config::get('djetson.shop::payments.methods');

        if (!array_key_exists($this->provider, $providerList)) {
            throw new ApplicationException(trans('djetson.shop::lang.payment_methods.errors.provider_not_found', [
                'provider' => $this->provider,
            ]));
        }
    }
}