<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;

/**
 * Product Model
 * @package Djetson\Shop
 *
 * @property \Djetson\Shop\Models\Binding                   $bindings
 * @property \Djetson\Shop\Models\Category                  $category
 * @property \Djetson\Shop\Models\Category                  $categories
 * @property \Djetson\Shop\Models\Product                   $featured
 * @property \Djetson\Shop\Models\Manufacturer              $manufacturer
 * @property \Djetson\Shop\Models\Property                  $properties
 * @property \Djetson\Shop\Models\Warehouse                 $warehouses
 *
 * @method \October\Rain\Database\Relations\BelongsTo       category
 * @method \October\Rain\Database\Relations\BelongsTo       manufacturer
 * @method \October\Rain\Database\Relations\BelongsToMany   bindings
 * @method \October\Rain\Database\Relations\BelongsToMany   categories
 * @method \October\Rain\Database\Relations\BelongsToMany   featured
 * @method \October\Rain\Database\Relations\BelongsToMany   properties
 * @method \October\Rain\Database\Relations\BelongsToMany   warehouses
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Sluggable
 * @mixin \October\Rain\Database\Traits\Validation
 * @mixin \October\Rain\Database\Traits\SoftDelete
 */
class Product extends Model
{
    use Sluggable;
    use Validation;
    use SoftDelete;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_products';

    /** @var array The accessors to append to the model's array form. */
    protected $appends = [
        'quantity',
    ];

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        // Base
        'name',
        'slug',
        'description',
        // Code
        'sku',
        'isbn',
        // Price
        'price',
        // Delivery
        'package_width',
        'package_height',
        'package_depth',
        'package_weight',
        // Seo
        'meta_title',
        'meta_keywords',
        'meta_description',
        // States
        'is_active',
        'is_searchable',
        'is_unique_text'
    ];

    /** @var array Generate slugs for these attributes. */
    protected $slugs = ['slug' => ['sku', 'name']];

    /** @var array Dates fields */
    protected $dates = ['deleted_at'];

    /** @var array Relations */
    public $belongsTo = [
        'category' => [
            'Djetson\Shop\Models\Category',
        ],
        'manufacturer' => [
            'Djetson\Shop\Models\Manufacturer',
        ],
    ];

    public $belongsToMany = [
        'bindings' => [
            'Djetson\Shop\Models\Binding',
            'table'         => 'djetshop_products_bindings',
            'key'           => 'product_id',
            'otherKey'      => 'binding_id',
        ],
        'categories' => [
            'Djetson\Shop\Models\Category',
            'table'         => 'djetshop_products_categories',
            'key'           => 'product_id',
            'otherKey'      => 'category_id',
        ],
        'properties' => [
            'Djetson\Shop\Models\Property',
            'table'         => 'djetshop_products_properties',
            'key'           => 'product_id',
            'otherKey'      => 'property_id',
            'pivot'         => ['property_value_id'],
            'pivotModel'    => 'Djetson\Shop\Models\ProductProperty'
        ],
        'featured' => [
            'Djetson\Shop\Models\Product',
            'table'         => 'djetshop_products_featured',
            'key'           => 'product_id',
            'otherKey'      => 'featured_id'
        ],
        'warehouses' => [
            'Djetson\Shop\Models\Warehouse',
            'table'         => 'djetshop_products_warehouses',
            'key'           => 'product_id',
            'otherKey'      => 'warehouse_id',
            'pivot'         => ['quantity'],
            'pivotModel'    => 'Djetson\Shop\Models\ProductWarehouse',
            'conditions'    => 'is_active = 1',
        ],
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
    ];

    /** @var array Validation rules */
    public $rules = [
        // Base
        'name'              => ['required', 'between:1,255'],
        'slug'              => ['required:update', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'between:1,255', 'unique:djetshop_products'],
        'sku'               => ['required', 'numeric', 'unique:djetshop_products'],
        'price'             => ['required', 'numeric'],
        // Sizes
        'package_width'     => ['numeric'],
        'package_height'    => ['numeric'],
        'package_depth'     => ['numeric'],
        'package_weight'    => ['numeric'],
        // Description
        'description'       => [],
        'meta_title'        => ['between:1,255'],
        'meta_keywords'     => ['between:1,255'],
        'meta_description'  => ['between:1,255'],
        // States
        'is_active'         => ['boolean'],
        'is_searchable'     => ['boolean'],
        'is_unique_text'    => ['boolean'],
    ];

    /**
     * @return mixed
     */
    public function getQuantityAttribute()
    {
        return $this->warehouses->sum('pivot.quantity');
    }

    /**
     * Get warehouses list
     */
    public function getWarehousesList()
    {
        return $this->warehouses->pluck('name', 'id');
    }

    /**
     *
     * @param $warehouse_id
     * @return int
     */
    public function getWarehouseQuantity($warehouse_id)
    {
        $warehouse = $this->warehouses()->wherePivot('warehouse_id', $warehouse_id)->first();

        return $warehouse ? $warehouse->pivot->quantity : 0;
    }
}