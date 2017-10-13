<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class ProductTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @property \Djetson\Shop\Models\Product $model
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class ProductTest extends PluginTestCase
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
        $this->model = factory('Djetson\Shop\Models\Product')->make();
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
     * Relation test | BelongTo category
     */
    public function test_relation_belong_to_category()
    {
        $this->helperBelongTo($this->model, 'category', 'name');
    }

    /**
     * Relation test | BelongTo manufacturer
     */
    public function test_relation_belong_to_manufacturer()
    {
        $this->helperBelongTo($this->model, 'manufacturer', 'name');
    }

    /**
     * Relation test | BelongToMany bindings
     */
    public function test_relation_belong_to_many_bindings()
    {
        $this->helperBelongToMany($this->model, 'bindings');
    }

    /**
     * Relation test | BelongToMany categories
     */
    public function test_relation_belong_to_many_categories()
    {
        $this->helperBelongToMany($this->model, 'categories');
    }

    /**
     * Relation test | BelongToMany featured
     */
    public function test_relation_belong_to_many_featured()
    {
        $this->helperBelongToMany($this->model, 'featured');
    }
}