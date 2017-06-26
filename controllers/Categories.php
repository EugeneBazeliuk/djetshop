<?php namespace Djetson\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Djetson\Shop\Models\Category;

/**
 * Categories Back-end Controller
 */
class Categories extends Controller
{
    public $bodyClass = 'compact-container';

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

    public function setScoreboardValues()
    {
        $this->vars['count_enabled']    = Category::where('is_active', true)->count();
        $this->vars['count_disabled']   = Category::where('is_active', false)->count();
        $this->vars['count_deleted']    = Category::onlyTrashed()->count();
    }

    public function index()
    {
        $this->setScoreboardValues();
        $this->asExtension('ListController')->index();
    }
}