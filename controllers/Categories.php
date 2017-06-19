<?php namespace Djetson\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $requiredPermissions = ['djetson.shop.access_categories'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Djetson.Shop', 'shop', 'categories');
    }
}
