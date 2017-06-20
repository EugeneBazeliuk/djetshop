<?php namespace Djetson\Shop\Tests\Models;

use PluginTestCase;
use Djetson\Shop\Models\ShippingMethod;
use Djetson\Shop\Traits\ModelTestHelper;

class ShippingMethodsTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\ShippingMethod';

    /**
     * Test creation model
     */
    public function test_creation()
    {
        $model = ShippingMethod::create([
            'name' => 'Test Shipping method',
            'provider' => 'self',
            'cost' => 35.00,
            'free_shipping_limit' => 1000,
            'is_active' => true,
            'is_allow_in_order' => false,
            'is_allow_free_shipping' => false,
        ]);

        $this->seeInDatabase($model->getTable(), ['name' => $model->name]);
    }
}