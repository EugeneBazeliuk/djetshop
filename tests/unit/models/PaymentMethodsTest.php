<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Models\PaymentMethod;
use Djetson\Shop\Tests\ModelTestHelper;

class PaymentMethodsTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\PaymentMethodsTest';

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
        $model = PaymentMethod::create([
            'name' => 'Test Payment method',
            'provider' => 'self',
            'is_active' => true,
        ]);

        $this->seeInDatabase($model->getTable(), ['name' => $model->name]);
    }
}