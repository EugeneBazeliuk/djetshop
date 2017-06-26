<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

class ShippingMethodsTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\ShippingMethod';

    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
    }

    /**
     * Test creation model
     */
    public function test_creation()
    {
        $this->createHelper(new $this->class, 'name');
    }
}