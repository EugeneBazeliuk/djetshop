<?php namespace Djetson\Shop\Models;

use Model;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;

/**
 * Warehouse Model
 *
 * @property int        $id
 * @property string     $name
 * @property string     $code
 * @property string     $description
 * @property bool       $is_active
 *
 * @property \Djetson\Shop\Models\Product   $products
 *
 * @method  \October\Rain\Database\Relations\BelongsToMany      products
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Traits\Sluggable
 * @mixin \October\Rain\Database\Traits\Validation
 */
class Warehouse extends Model
{
    use Sluggable;
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_warehouses';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        // Base
        'name',
        'code',
        'description',
        // States
        'is_active'
    ];

    /** @var array Validation rules */
    public $rules = [
        // Base
        'name'          => ['required', 'between:1,255'],
        'code'          => ['required:update', 'between:1,255', 'unique:djetshop_warehouses'],
        'description'   => [],
        // States
        'is_active'     => ['boolean'],
    ];

    /** @var array Generate slugs for these attributes. */
    protected $slugs = ['code' => 'name'];

    /** @var array Relation BelongsToMany */
    public $belongsToMany = [
        'products' => [
            'Djetson\Shop\Models\Product',
            'table'         => 'djetshop_products_warehouses',
            'key'           => 'warehouse_id',
            'otherKey'      => 'product_id',
            'pivot'         => ['quantity'],
            'pivotModel'    => 'Djetson\Shop\Models\ProductWarehouse'
        ],
    ];

    /**
     * Get count products attribute
     * @return mixed
     */
    public function getCountProductsAttribute()
    {
        return $this->products->sum('pivot.quantity');
    }
}