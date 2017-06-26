<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

class ProductTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\Product';

    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
    }

    /**
     * Creation test
     */
    public function test_create()
    {
        $this->createHelper(new $this->class, 'name');
    }

    /**
     * Creation with sluggable trait test
     */
    public function test_create_with_slugable_trait()
    {
        $this->createSluggableHelper(new $this->class, 'slug');
    }

    /**
     * Relation BelongTo | Category
     */
    public function test_relation_belong_to_category()
    {
        $this->helperBelongTo(new $this->class, 'category');
    }

    /**
     * Relation BelongTo | Manufacturer
     */
    public function test_relation_belong_to_manufacturer()
    {
        $this->helperBelongTo(new $this->class, 'manufacturer');
    }

    /**
     * Relation BelongToMany | Categories
     */
    public function test_relation_belong_to_many_categories()
    {
        $this->helperBelongToMany(new $this->class, 'categories');
    }

    /**
     * Relation BelongToMany | Featured
     */
    public function test_relation_belong_to_many_featured()
    {
        $this->helperBelongToMany(new $this->class, 'featured');
    }
}