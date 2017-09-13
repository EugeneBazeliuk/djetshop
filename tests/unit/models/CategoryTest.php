<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class CategoryTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @property \Djetson\Shop\Models\Category $model
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class CategoryTest extends PluginTestCase
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
        $this->model = factory('Djetson\Shop\Models\Category')->make();
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
}