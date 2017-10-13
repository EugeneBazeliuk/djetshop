<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class BindingTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @property \Djetson\Shop\Models\Binding $model
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class BindingTest extends PluginTestCase
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
        $this->model = factory('Djetson\Shop\Models\Binding')->make([
            'type' => factory('Djetson\Shop\Models\BindingType')->create()
        ]);
    }

    /**
     * Create model test
     */
    public function test_create()
    {
        $this->helperCreateModel($this->model, 'name');
    }

    /**
     * Create sluggable test
     */
    public function test_create_sluggable()
    {
        $this->helperCreateWithSluggable($this->model, 'name', 'slug');
    }

    /**
     * Relation test | BelongTo bindingType
     */
    public function test_relation_belong_to_binding_type()
    {
        $this->helperBelongTo($this->model, 'type', 'name');
    }

    /**
     * Relation test | BelongToMany products
     */
    public function test_relation_belong_to_many_products()
    {
        $this->helperBelongToMany($this->model, 'products');
    }
}