<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class PropertyGroupTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @property \Djetson\Shop\Models\PropertyValue $model
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class PropertyValueTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $model;

    /**
     * SetUp Test
     */
    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
        $this->model = factory('Djetson\Shop\Models\PropertyValue')->make([
            'property' => factory('Djetson\Shop\Models\Property')->create()
        ]);
    }

    /**
     * Create model test
     */
    public function test_create()
    {
        $this->helperCreateModel($this->model, 'value');
    }

    /**
     * Relation test | BelongTo property
     */
    public function test_relation_belong_to_property()
    {
        $this->helperBelongTo($this->model, 'property', 'name');
    }
}