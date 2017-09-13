<?php namespace Djetson\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * OrderItem Model
 *
 * @property int    $id
 * @property string $name
 * @property string $sku
 * @property int    $quantity
 * @property double $price
 * @property double $total
 *
 * @property \Djetson\Shop\Models\Order $order
 * @property \Djetson\Shop\Models\Product $product
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
 */
class OrderItem extends Model
{
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_order_items';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        'price',
        'quantity'
    ];

    /** @var array Relations */
    public $belongsTo = [
        'order' => 'Djetson\Shop\Models\Order',
        'product' => 'Djetson\Shop\Models\Product',
    ];

    /** @var array Validation rules */
    public $rules = [
        'order'     => ['required'],
        'product'   => ['required'],
        'price'     => ['required', 'numeric', 'min:0'],
        'quantity'  => ['required', 'integer', 'min:1'],
    ];

    //
    // Events
    //
    public function beforeCreate()
    {
        $this->name = $this->product->name;
        $this->sku = $this->product->sku;
    }

    public function beforeSave()
    {
        $this->total = $this->price * $this->quantity;
    }

    //
    // Filter
    //
    public function filterFields($fields, $context = null)
    {
        if ($context == 'create' && $this->product) {
            $fields->price->value = $this->product->price;
        }
    }
}