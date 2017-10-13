<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;

/**
 * Binding Model
 *
 * @property int                $id
 * @property string             $name
 * @property string             $description
 * @property string             $meta_title
 * @property string             $meta_keywords
 * @property string             $meta_description
 * @property boolean            $is_active
 * @property boolean            $is_searchable
 * @property \Carbon\Carbon     $created_at
 * @property \Carbon\Carbon     $updated_at
 *
 * @property \Djetson\Shop\Models\BindingType   $type
 * @property \Djetson\Shop\Models\Product       $products
 *
 * @method \October\Rain\Database\Relations\BelongsTo       type
 * @method \October\Rain\Database\Relations\BelongsToMany   products
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Traits\Sluggable
 * @mixin \October\Rain\Database\Traits\Validation
 * @mixin \October\Rain\Database\Traits\SoftDelete
 */
class Binding extends Model
{
    use Sluggable;
    use Validation;
    use SoftDelete;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_bindings';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        // Base
        'name',
        'description',
        // Meta
        'meta_title',
        'meta_keywords',
        'meta_description',
        // States
        'is_active',
        'is_searchable',
    ];

    /** @var array Generate slugs for these attributes. */
    protected $slugs = ['slug' => 'name'];

    /** @var array Dates fields */
    protected $dates = ['deleted_at'];

    /** @var array Relations */
    public $belongsTo = [
        'type' => [
            'Djetson\Shop\Models\BindingType',
        ],
    ];

    public $belongsToMany = [
        'products' => [
            'Djetson\Shop\Models\Product',
            'table'         => 'djetshop_products_bindings',
            'key'           => 'binding_id',
            'otherKey'      => 'product_id',
        ],
    ];

    public $attachOne = [
        'image' => ['System\Models\File', 'delete' => true]
    ];

    /** @var array Validation rules */
    public $rules = [
        // Base
        'name'              => ['required', 'between:1,255'],
        'slug'              => ['required:update', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'between:1,255', 'unique:djetshop_bindings'],
        'description'       => [],
        // Meta
        'meta_title'        => ['between:1,255'],
        'meta_keywords'     => ['between:1,255'],
        'meta_description'  => ['between:1,255'],
        // States
        'is_active'         => ['boolean'],
        'is_searchable'     => ['boolean'],
    ];
}