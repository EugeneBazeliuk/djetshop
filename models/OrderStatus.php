<?php namespace Djetson\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * OrderStatus Model
 */
class OrderStatus extends Model
{
    use Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_order_statuses';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [

    ];

    /** @var array Validation rules */
    public $rules = [];
}