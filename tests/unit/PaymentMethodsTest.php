<?php namespace Djetson\Shop\Tests\Models;

use PluginTestCase;
use Djetson\Shop\Models\PaymentMethod;
use Djetson\Shop\Traits\ModelTestHelper;

class PaymentMethodsTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\PaymentMethodsTest';

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