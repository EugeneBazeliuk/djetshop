<?php namespace Djetson\Shop\Tests\Models;

use PluginTestCase;
use Djetson\Shop\Models\OrderStatus;
use Djetson\Shop\Traits\ModelTestHelper;

class OrderStatusesTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\OrderStatuses';

    /**
     * Test creation model
     */
    public function test_creation()
    {
        $model = OrderStatus::create([
            'name' => 'Test Status',
            'color' => '#EEE',
            'is_active' => true,
            'is_send_email' => false,
            'is_attach_invoice' => false,
        ]);

        $this->seeInDatabase($model->getTable(), ['name' => $model->name]);
    }
}