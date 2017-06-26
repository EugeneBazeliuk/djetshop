<?php namespace Djetson\Shop\Models;

use Model;

/**
 * PropertyValue Model
 */
class PropertyValue extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetson_shop_property_values';

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
