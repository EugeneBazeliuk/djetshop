<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;

/**
 * Order Model
 */
class Order extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetshop_shop_orders';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
