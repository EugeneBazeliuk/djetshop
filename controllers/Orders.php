<?php namespace Djetson\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Orders Back-end Controller
 * @mixin \Backend\Behaviors\FormController
 * @mixin \Backend\Behaviors\ListController
 * @mixin \Backend\Behaviors\RelationController
 */
class Orders extends Controller
{
    public $bodyClass = 'compact-container';

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['djetson.shop.access_orders'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Djetson.Shop', 'shop', 'orders');
        // Add custom css styles
        $this->addCss('/plugins/djetson/shop/assets/css/style.css');
    }

//    /**
//     * @param $field
//     *
//     * @return array
//     */
//    public function relationExtendRefreshResults($field)
//    {
//        /** @var \Djetson\Shop\Models\Order $model */
//        $model = $this->formGetModel();
//
////        if ($field == 'items') {
////            return [
////                '#order-items-total' => $this->makePartial('partials/field_totals', ['totals' => $model->fresh()->getAttribute('text_totals')])
////            ];
////        }
//    }
}