<?php namespace Djetson\Shop\Tests\Models;

use PluginTestCase;
use Djetson\Shop\Traits\ModelTestHelper;

class ManufacturerTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\Manufacturer';

    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
    }

    public function test_creation()
    {
        $this->createHelper(new $this->class, 'name');
    }
}