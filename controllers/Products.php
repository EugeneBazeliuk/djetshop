<?php namespace Djetson\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Djetson\Shop\Models\Product;

/**
 * Products Back-end Controller
 */
class Products extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        'Backend.Behaviors.ImportExportController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';
    public $requiredPermissions = ['djetson.shop.access_product'];
    public $importExportConfig = 'config_import_export.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Djetson.Shop', 'shop', 'products');
        // Add custom css styles
        $this->addCss('/plugins/djetson/shop/assets/css/style.css');
    }

    public function index()
    {
        $this->vars['scoreboard'] = $this->getListScoreboard();
        $this->asExtension('ListController')->index();
    }

    public function create($context = null)
    {
        $this->bodyClass = 'compact-container';
        return $this->asExtension('FormController')->create($context);
    }

    public function update($recordId, $context = null)
    {
        $this->bodyClass = 'compact-container';
        return $this->asExtension('FormController')->update($recordId, $context);
    }

    private function getListScoreboard()
    {
        return [
            'enabled_count' => Product::where('is_active', 1)->count(),
            'disabled_count' => Product::where('is_active', 0)->count(),
            'deleted_count' => Product::onlyTrashed()->count()
        ];
    }

    /**
     * @param \Djetson\Shop\Models\Product $query
     */
    public function listExtendQuery($query)
    {
        $query->withTrashed();
    }
}