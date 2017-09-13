<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class PropertyGroupTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @property \Djetson\Shop\Models\PropertyGroup $model
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class PropertyGroupTest extends PluginTestCase
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
        $this->model = factory('Djetson\Shop\Models\PropertyGroup')->make();
    }

    /**
     * Create model test
     */
    public function test_create()
    {
        $this->helperCreateModel($this->model, 'name');
    }
}