<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class PaymentMethodsTest
 * @package Djetson\Shop\Tests\Unit\Models
 */
class PropertyTest extends PluginTestCase
{
    use ModelTestHelper;

    /** @var \Djetson\Shop\Models\Property */
    protected $model;

    /**
     * SetUp Test
     */
    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
        $this->model = factory('Djetson\Shop\Models\Property')->make();
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
        $this->helperCreateWithSluggable($this->model, 'name', 'code');
    }

    /**
     * Relation test | BelongTo group
     */
    public function test_relation_belong_to_category()
    {
        $this->helperBelongTo($this->model, 'group', 'name');
    }

    /**
     * Relation test | HasMany values
     */
    public function test_relation_has_many_values()
    {
        $this->helperHasMany($this->model, 'values');
    }
}