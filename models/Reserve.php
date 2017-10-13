<?php namespace Djetson\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Reserve Model
 *
 * @property int    $id
 * @property int    $quantity
 * @property double $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $reserved_to
 *
 * @property-read \Djetson\Shop\Models\Product $product
 * @property-read \Djetson\Shop\Models\Warehouse $warehouse
 *
 * @method \October\Rain\Database\Relations\BelongsToMany   products
 *
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
 */
class Reserve extends Model
{
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_reserves';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        'price',
        'quantity',
    ];

    protected $dates = [
        'reserved_to'
    ];

    /** @var array Validation rules */
    public $rules = [
        'product'   => ['required'],
        'warehouse' => ['required'],
        'quantity'  => ['required', 'integer', 'min:1'],
    ];

    /** @var array Relations */
    public $belongsTo = [
        'product' => 'Djetson\Shop\Models\Product',
        'warehouse' => [
            'Djetson\Shop\Models\Warehouse',
        ],
    ];

    //
    // Action
    //
    public function beforeValidate()
    {
        // Add max quantity validation
        if ($this->product && $this->warehouse) {
            array_push($this->rules['quantity'], sprintf('max:%d', $this->product->getWarehouseQuantity($this->warehouse->id)));
        }
    }

    public function beforeCreate()
    {
        //$this->reserved_to = Carbon::now()->addMinutes(15);
    }

    public function beforeSave()
    {

    }

    /**
     * Get product warehouses
     * @return array
     */
    public function ProductWarehousesList()
    {
        if ($this->product) {
            return $this->product->warehouses->pluck('name', 'id');
        }

        return [];
    }
}