<?php namespace Djetson\Shop\Tests\Unit\Models;

use Djetson\Shop\Models\Order;
use Djetson\Shop\Models\OrderItem;
use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class OrderTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @property \Djetson\Shop\Models\Order $model
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class OrderTest extends PluginTestCase
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
        //$this->model = factory('Djetson\Shop\Models\Order')->make();
    }

    /**
     * Create model test
     */
    public function test_create()
    {
        $product = factory('Djetson\Shop\Models\Product')->create();

        $orderItem = factory('Djetson\Shop\Models\OrderItem')->make([
            'price' => 100,
            'quantity' => 10,
            'product_id' => $product->id,
        ]);

        $model = new Order();
        $model->payment_method = factory('Djetson\Shop\Models\PaymentMethod')->create();
        $model->shipping_method = factory('Djetson\Shop\Models\ShippingMethod')->create();
        $model->items = $orderItem;
        $model->save();
    }
}