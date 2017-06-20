<?php namespace Djetson\Shop\Models;

use Model;
use \October\Rain\Database\Traits\Validation;

/**
 * OrderStatus Model
 * @packa
 */
class OrderStatus extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'djetshop_order_statuses';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'color',
        'mail_template_id',
        'is_active',
        'is_send_email',
        'is_attach_invoice'
    ];

    public $rules = [
        'name' =>   ['required'],
        'color' =>  ['required'],
        'mail_template_id' =>   ['required_if:is_send_email,1'],
        'is_send_email' =>      ['boolean'],
        'is_attach_invoice'  => ['boolean'],
        'is_active' =>          ['boolean'],
    ];
}
