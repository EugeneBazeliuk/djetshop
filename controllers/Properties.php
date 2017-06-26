<?php namespace Djetson\Shop\Controllers;

use BackendMenu;
use System\Classes\SettingsManager;
use Backend\Classes\Controller;

/**
 * Properties Back-end Controller
 */
class Properties extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Djetson.Shop', 'properties');
    }
}
