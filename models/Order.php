<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

/**
 * Order Model
 *
 * @property int $id
 * @property float  $total
 * @property float  $sub_total
 * @property float  $payment_total
 * @property float  $shipping_total
 * @property string $comment
 * @property string $phone
 * @property string $track
 *
 * @property \Backend\Models\User                       $manager
 * @property \Rainlab\User\Models\User                  $customer
 * @property \Djetson\Shop\Models\OrderItem             $items
 * @property \Djetson\Shop\Models\Status                $status
 * @property \Djetson\Shop\Models\PaymentMethod         $payment_method
 * @property \Djetson\Shop\Models\ShippingMethod        $shipping_method
 *
 * @method \October\Rain\Database\Relations\HasMany     items
 * @method \October\Rain\Database\Relations\BelongsTo   customer
 * @method \October\Rain\Database\Relations\BelongsTo   status
 * @method \October\Rain\Database\Relations\BelongsTo   payment_method
 * @method \October\Rain\Database\Relations\BelongsTo   shipping_method
 * @method \October\Rain\Database\Relations\BelongsTo   manager
 *
 * @mixin \Eloquent
 */
class Order extends Model
{
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_orders';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        'comment',
        'phone',
        'track'
    ];

    /** @var array Json fields */
    protected $jsonable  = ['shipping_address', 'billing_address'];

    /** @var array Relation HasMany */
    public $hasMany = [
        'items' => [
            'Djetson\Shop\Models\OrderItem',
        ]
    ];

    /** @var array Relation BelongTo */
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
        'phone'         => [],
        'comment'       => [],
        'track'         => [],
        'payment_method'        => [],
        'shipping_method'       => [],
    ];

    /**
     * Action | BeforeCreate
     */
    public function beforeCreate()
    {
        $this->payment_total = $this->getPaymentTotal();
        $this->shipping_total = $this->getShippingTotal();
        $this->total = $this->getTotal();
    }

    /**
     * Action | beforeUpdate
     */
    public function beforeUpdate()
    {
        // Update Payment total
        if ($this->isDirty('sub_total', 'payment_method_id')) {
            $this->payment_total = $this->getPaymentTotal();
        }

        // Update Shipping total
        if ($this->isDirty('sub_total', 'shipping_method_id')) {
            $this->shipping_total = $this->getShippingTotal();
        }

        // Update Total
        if ($this->isDirty('sub_total', 'payment_method_id', 'shipping_method_id')) {
            $this->total = $this->getTotal();
        }
    }

    /**
     * Get text total Attribute
     */
    public function getTextTotalAttribute()
    {
        return Settings::formatPrice($this->total);
    }

    /**
     * Get text subtotal Attribute
     */
    public function getTextSubtotalAttribute()
    {
        return Settings::formatPrice($this->sub_total);
    }

    /**
     * Get text total Attribute
     */
    public function getTextShippingTotalAttribute()
    {
        return Settings::formatPrice($this->shipping_total);
    }

    /**
     * Get text total Attribute
     */
    public function getTextPaymentTotalAttribute()
    {
        return Settings::formatPrice($this->payment_total);
    }

    /**
     * Get totals Attribute
     * @return array
     */
    public function getTotalsAttribute()
    {
        $totals = [];

        // Add subtotal
        array_push($totals, ['title' => trans('djetson.shop::lang.orders.sub_total'), 'value' => $this->sub_total ]);
        // Add payment total
        $this->payment_total ? array_push($totals, ['title' => $this->payment_method->name, 'value' => $this->payment_total ]) : null;
        // Add shipping total
        $this->shipping_total ? array_push($totals, ['title' => $this->shipping_method->name, 'value' => $this->shipping_total ]) : null;
        // Add total
        array_push($totals, ['title' => trans('djetson.shop::lang.orders.total'), 'value' => $this->total ]);

        return $totals;
    }

    /**
     * Get Payment total
     */
    private function getPaymentTotal()
    {
        if (Settings::get('order_allow_payment_total', false) && $this->payment_method) {
            return $this->payment_method->calculateTotal($this->sub_total);
        } else {
            return null;
        }
    }

    /**
     * Get Shipping total
     */
    private function getShippingTotal()
    {
        if (Settings::get('order_allow_shipping_total', false) && $this->shipping_method) {
            return $this->shipping_method->calculateTotal($this->sub_total);
        } else {
            return null;
        }
    }

    /**
     * Get Total
     */
    private function getTotal()
    {
        $total = $this->sub_total;

        if ($this->payment_total) {
            $total += $this->payment_total;
        }

        if ($this->shipping_total) {
            $total += $this->shipping_total;
        }

        return $total;
    }
}