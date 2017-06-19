<?php namespace Djetson\Shop\Tests\Models;

use PluginTestCase;
use Djetson\Shop\Traits\ModelTestHelper;

class OrderTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\Order';

    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
    }
}