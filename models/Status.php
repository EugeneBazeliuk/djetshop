<?php namespace Djetson\Shop\Models;

use Model;

/**
 * Status Model
 *
 * @property int                $id
 * @property string             $name
 * @property string             $color
 * @property bool               $is_active
 * @property bool               $is_send_email
 * @property bool               $is_attach_invoice
 * @property int                $mail_template_id
 * @property \Carbon\Carbon     $created_at
 * @property \Carbon\Carbon     $updated_at
 *
 * @property-read \System\Models\MailTemplate $mail_template
 *
 * @mixin \Eloquent
 * @mixin \October\Rain\Database\Model
 * @mixin \October\Rain\Database\Traits\Validation
 */
class Status extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /** @var string The database table used by the model. */
    public $table = 'djetshop_statuses';

    /** @var array Guarded fields */
    protected $guarded = ['*'];

    /** @var array Fillable fields */
    protected $fillable = [
        'name',
        'color',
        'is_active',
        'is_send_email',
        'is_attach_invoice'
    ];

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
