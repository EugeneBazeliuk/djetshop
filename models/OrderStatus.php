<?php namespace Djetson\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

/**
 * OrderStatus Model
 * @package Djetson\Shop
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $mail_template_id
 * @property bool $is_active
 * @property bool $is_send_email
 * @property bool $is_attach_invoice
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereIsAttachInvoice($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereIsSendEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereMailTemplateId($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Djetson\Shop\Models\OrderStatus whereUpdatedAt($value)
 *
 * @method \October\Rain\Database\Relations\BelongsTo mail_template
 * @property \System\Models\MailTemplate $mail_template
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
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
        'name',
        'color',
        'mail_template_id',
        'is_active',
        'is_send_email',
        'is_attach_invoice'
    ];

    /** @var string The database timestamps. */
    public $timestamps = false;

    /** @var array Relations */
    public $belongsTo = [
        'mail_template' => [
            'System\Models\MailTemplate',
            'key' => 'mail_template_id'
        ],
    ];

    /** @var array Validation rules */
    public $rules = [
        'name'              => ['required'],
        'color'             => ['required'],
        'mail_template'     => ['required_if:is_send_email,1'],
        'is_send_email'     => ['boolean'],
        'is_attach_invoice' => ['boolean'],
        'is_active'         => ['boolean'],
    ];
}
