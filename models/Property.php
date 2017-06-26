<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

/**
 * Property Model
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
 */
class Property extends Model
{
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_properties';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active'
    ];

    /** @var array Relations */

    /** @var array Validation rules */
    public $rules = [
        'name'          => ['required', 'between:1,255'],
        'code'          => ['required', 'alpha_dash', 'between:1,255', 'unique:djetshop_properties'],
        'description'   => [],
        'is_active'     => ['boolean'],
    ];
}
