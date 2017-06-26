<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;

/**
 * Product Model
 * @package Djetson\Shop
 *
 * @property \Djetson\Shop\Models\Category $category
 * @method \October\Rain\Database\Relations\BelongsTo category
 *
 * @property \Djetson\Shop\Models\Manufacturer $manufacturer
 * @method \October\Rain\Database\Relations\BelongsTo manufacturer
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

    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetshop_products';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        // Base
        'name',
        'sku',
        'isbn',
        'price',
        // Sizes
        'package_width',
        'package_height',
        'package_depth',
        'package_weight',
        // Description
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        // States
        'is_active',
        'is_searchable',
        'is_unique_text'
    ];

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => ['sku', 'name']];

    /**
     * @var array Dates fields
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'category' => [
            'Djetson\Shop\Models\Category',
        ],
        'manufacturer' => [
            'Djetson\Shop\Models\Manufacturer',
        ],
    ];

    public $belongsToMany = [
        'categories' => [
            'Djetson\Shop\Models\Category',
            'table'         => 'djetshop_products_categories',
            'key'           => 'product_id',
            'otherKey'      => 'category_id',
        ],
        'featured' => [
            'Djetson\Shop\Models\Product',
            'table'         => 'djetshop_products_featured',
            'key'           => 'product_id',
            'otherKey'      => 'featured_id'
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
        'slug'              => ['regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'between:1,255', 'unique:djetshop_products'],
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
     * Action BeforeValidate
     */
    public function beforeValidate()
    {
        if ($this->exists) {
            array_push($this->rules['slug'], 'required');
        }
    }
}
