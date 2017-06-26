<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

class CurrencyTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\Currency';

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