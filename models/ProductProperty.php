<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Pivot;
use October\Rain\Database\Traits\Validation;

/**
 * ProductProperty Model
 *
 * @property \Djetson\Shop\Models\Product $product
 * @method \October\Rain\Database\Relations\BelongsTo product
 *
 * @property \Djetson\Shop\Models\Property $property
 * @method \October\Rain\Database\Relations\BelongsTo property
 *
 * @property \Djetson\Shop\Models\PropertyValue $property_value
 * @method \October\Rain\Database\Relations\BelongsTo property_value
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 */
class ProductProperty extends Pivot
{
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_products_properties';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [];

    /** @var array Relations */
    public $belongsTo = [
        'product' => [
            'Djetson\Shop\Models\Product',
        ],
        'property' => [
            'Djetson\Shop\Models\Property',
        ],
        'property_value' => [
            'Djetson\Shop\Models\PropertyValue',
        ],
    ];

    /** @var array Validation rules */
    public $rules = [
        'product' => ['required'],
        'property' => ['required'],
        'property_value' => ['required']
    ];

    public function getPropertyValueIdOptions()
    {
        if ($this->exists) {
            $id = $this->property->id;
        } elseif (count(post('foreign_id'))) {
            $id = post('foreign_id');
        } else {
            throw new \ApplicationException('Error');
        }

        return PropertyValue::where('property_id', $id)->lists('value', 'id');
    }
}