<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

/**
 * Class OrderTest
 * @package Djetson\Shop\Tests\Unit\Models
 */
class OrderTest extends PluginTestCase
{
    use ModelTestHelper;

    /** @var \Djetson\Shop\Models\Order */
    protected $model;

    /**
     * SetUp Test
     */
    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
        $this->model = factory('Djetson\Shop\Models\Order')->make([
            'status' => factory('Djetson\Shop\Models\Status')->create(),
            'payment_method' => factory('Djetson\Shop\Models\PaymentMethod')->create(),
            'shipping_method' => factory('Djetson\Shop\Models\ShippingMethod')->create(),
        ]);
    }

    /**
     * Create model test
     */
    public function test_create()
    {
        $this->helperCreateModel($this->model, 'phone');
    }

    /**
     * Relation test | BelongTo status
     */
    public function test_relation_belong_to_status()
    {
        $this->helperBelongTo($this->model, 'status', 'name');
    }

    /**
     * Relation test | BelongTo payment_method
     */
    public function test_relation_belong_to_payment_method()
    {
        $this->helperBelongTo($this->model, 'payment_method', 'name');
    }

    /**
     * Relation test | BelongTo shipping_method
     */
    public function test_relation_belong_to_shipping_method()
    {
        $this->helperBelongTo($this->model, 'shipping_method', 'name');
    }

    /**
     * Relation test | HasMany shipping_method
     */
    public function test_relation_has_many_items()
    {
        $this->model->items = factory('Djetson\Shop\Models\OrderItem', 3)->make([
            'product' => factory('Djetson\Shop\Models\Product')->create(),
            'warehouse' => factory('Djetson\Shop\Models\Warehouse')->create()
        ]);
        $this->model->save();

        $this->assertEquals(3, $this->model->items->count());
    }

    /**
     * Test order subtotal
     */
    public function test_order_items_sum()
    {
        $item = factory('Djetson\Shop\Models\OrderItem')->make([
            'product' => factory('Djetson\Shop\Models\Product')->create(),
            'warehouse' => factory('Djetson\Shop\Models\Warehouse')->create(),
            'price' => 10.25,
            'quantity' => 4,
        ]);

        $order = factory('Djetson\Shop\Models\Order')->create([
            'status' => factory('Djetson\Shop\Models\Status')->create(),
            'payment_method' => factory('Djetson\Shop\Models\PaymentMethod')->create(),
            'shipping_method' => factory('Djetson\Shop\Models\ShippingMethod')->create(),
        ]);

        $order->items()->add($item);

        $model = \Djetson\Shop\Models\Order::find($order->id);
        $this->assertEquals(41, $model->subtotal);
    }
}