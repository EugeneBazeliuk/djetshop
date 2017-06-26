<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\NestedTree;

/**
 * Category Model
 * @package Djetson\Shop
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Sluggable
 * @mixin \October\Rain\Database\Traits\Validation
 * @mixin \October\Rain\Database\Traits\SoftDelete
 * @mixin \October\Rain\Database\Traits\NestedTree
 */
class Category extends Model
{
    use Sluggable;
    use Validation;
    use SoftDelete;
    use NestedTree;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetshop_categories';

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
        // Description
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        // States
        'is_active',
        'is_searchable',
    ];

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var array Dates fields
     */
    protected $dates = ['deleted_at'];

    /** @var array Validation rules */
    public $rules = [
        // Base
        'name' => ['required', 'between:1,255'],
        'slug'      => ['regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'between:1,255', 'unique:djetshop_categories'],
        // Description
        'description'       => [],
        'meta_title'        => ['between:1,255'],
        'meta_keywords'     => ['between:1,255'],
        'meta_description'  => ['between:1,255'],
        // States
        'is_active'         => ['boolean'],
        'is_searchable'     => ['boolean'],
    ];

    /**
     * Relations
     */
    public $attachOne = [
        'image' => 'System\Models\File'
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
