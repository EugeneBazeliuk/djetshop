<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;


/**
 * Order Model
 *
 * @property int    $id
 * @property float  $total
 * @property float  $subtotal
 * @property float  $payment_cost
 * @property int    $payment_status_id
 * @property float  $shipping_cost
 * @property bool   $is_closed
 *
 * @property \Rainlab\User\Models\User $customer
 * @property \Djetson\Shop\Models\OrderItem $items
 * @property \Djetson\Shop\Models\OrderStatus $statuses
 * @property \Backend\Models\User $manager
 * @property \Djetson\Shop\Models\PaymentMethod $payment_method
 * @property \Djetson\Shop\Models\Status $status
 * @property \Djetson\Shop\Models\ShippingMethod $shipping_method
 *
 * @method \October\Rain\Database\Relations\BelongsTo customer
 * @method \October\Rain\Database\Relations\BelongsTo status
 * @method \October\Rain\Database\Relations\BelongsTo payment_method
 * @method \October\Rain\Database\Relations\BelongsTo shipping_method
 * @method \October\Rain\Database\Relations\BelongsTo manager
 *
 * @method \October\Rain\Database\Relations\HasMany items
 * @method \October\Rain\Database\Relations\HasMany statuses
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
 */
class Order extends Model
{
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_orders';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [];

    /** @var array Json fields */
    protected $jsonable  = ['shipping_address', 'billing_address'];

    /** @var array Relations */
    public $hasMany = [
        'items' => [
            'Djetson\Shop\Models\OrderItem',
        ],
        'statuses' => [
            'Djetson\Shop\Models\OrderStatus',
        ]
    ];

    public $belongsTo = [
        'customer' => [
            'Rainlab\User\Models\User',
        ],
        'status' => [
            'Djetson\Shop\Models\Status',
        ],
        'payment_method' => [
            'Djetson\Shop\Models\PaymentMethod',
        ],
        'shipping_method' => [
            'Djetson\Shop\Models\ShippingMethod',
        ],
        'manager' => [
            'Backend\Models\User'
        ]
    ];

    /** @var array Validation rules */
    public $rules = [
        'payment_method'        => ['required'],
        'shipping_method'       => ['required'],
    ];

    //
    // Events
    //
    public function beforeCreate()
    {
        $this->status = Settings::instance()->order_status_new;

        // $this->manager = BackendAuth::getUser(); // @todo ошибка / извне нет менеджера
    }

    public function beforeSave()
    {
//        if ($this->is_closed) {
//            throw new ApplicationException(trans('djetson.shop::lang.orders.errors.order_is_closed'));
//        }
//
//        if ($this->checkDifference('status_id')) {
//            $this->statuses = new OrderStatus();
//        }
//

//

//

    }

    /**
     * Check attribute difference
     * @param $attribute
     * @return bool
     */
    public function checkDifference($attribute)
    {
        if ($this->getOriginal($attribute) != $this->$attribute) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Convert price to default format
     * @param float $price
     * @return string
     */
    public function formatPrice(float $price)
    {
        return (string) Settings::formatPrice($price);
    }

    /**
     * Update order total
     */
    public function updateOrderTotal()
    {
        $this->subtotal = $this->items->sum('total');

        // Check payment cost
        if ($this->checkDifference('subtotal') || $this->checkDifference('payment_method_id')) {
            $this->payment_cost = $this->payment_method->getCost($this);
        }

        // Check shipping cost
        if ($this->checkDifference('subtotal') || $this->checkDifference('shipping_method_id')) {
            $this->shipping_cost = $this->shipping_method->getCost($this);
        }

        // Update total
        $this->total = $this->subtotal + $this->payment_cost + $this->shipping_cost;
    }
}