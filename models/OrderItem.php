<?php namespace Djetson\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * OrderItem Model
 *
 * @property    int     $id
 * @property    int     $order_id
 * @property    int     $product_id
 * @property    int     $warehouse_id
 * @property    int     $quantity
 * @property    string  $name
 * @property    string  $sku
 * @property    double  $price
 * @property    double  $sum
 *
 * @property    \Djetson\Shop\Models\Order      $order
 * @property    \Djetson\Shop\Models\Product    $product
 * @property    \Djetson\Shop\Models\Warehouse  $warehouse
 *
 * @method      \October\Rain\Database\Relations\BelongsTo  order
 * @method      \October\Rain\Database\Relations\BelongsTo  product
 * @method      \October\Rain\Database\Relations\BelongsTo  warehouse
 *
 * @mixin \Eloquent
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
        'order',
        'price',
        'product',
        'quantity',
        'warehouse',
    ];

    /** @var array Relations */
    public $belongsTo = [
        'order' => 'Djetson\Shop\Models\Order',
        'product' => 'Djetson\Shop\Models\Product',
        'warehouse' => 'Djetson\Shop\Models\Warehouse',
    ];

    /** @var array Validation rules */
    public $rules = [
        'order_id'      => ['required'],
        'product_id'    => ['required'],
        'warehouse_id'  => ['required'],
        'price'         => ['required', 'numeric', 'min:0'],
        'quantity'      => ['required', 'integer', 'min:1'],
    ];

    /**
     * Field filter
     * @param      $fields
     */
    public function filterFields($fields)
    {
        // Fill price field if not exists
        if (!$this->exists) {
            $fields->price->value = $this->product ? $this->product->getAttribute('price') : '';
        }
    }

    /**
     * Action | BeforeCreate
     */
    public function beforeCreate()
    {
        $this->name = $this->product->name;
        $this->sku  = $this->product->sku;
    }

    /**
     * Action | BeforeSave
     */
    public function beforeSave()
    {
        $this->sum = $this->price * $this->quantity;
    }

    /**
     * Action | AfterSave
     */
//    public function afterSave()
//    {
//        $this->updateOrder($this->order_id);
//    }

    /**
     * Action | AfterUpdate
     */
//    public function beforeUpdate()
//    {
////        if ($this->isDirty(['product_id', 'warehouse_id'])) {
////            throw new \ApplicationException('запрещено менять склад или товар');
////        }
//    }

    /**
     * Action | AfterDelete
     */
//    public function afterDelete()
//    {
//        $this->updateOrder($this->order_id);
//    }

    /**
     * Get text sum
     */
    public function getTextSumAttribute()
    {
        return Settings::formatPrice($this->sum);
    }

    /**
     * Get text price
     */
    public function getTextPriceAttribute()
    {
        return Settings::formatPrice($this->price);
    }

    /**
     * Get Warehouse options
     * @return array
     */
    public function getWarehouseOptions()
    {
        return $this->product ? $this->product->getWarehousesList() : [];
    }

//    /**
//     * @param $order_id int
//     */
//    public function updateOrder($order_id)
//    {
//        Order::updateOrder($order_id);
//    }
}