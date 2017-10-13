<?php namespace Djetson\Shop\Seeders;

use Djetson\Shop\Models\Order;
use Djetson\Shop\Models\Status;
use Djetson\Shop\Models\PaymentMethod;
use Djetson\Shop\Models\ShippingMethod;


class orderSeeder
{
    public function run()
    {
        $status = Status::create([
            // Base
            'name' => 'Test status',
            'color' => '#2ecc71',
            // States
            'is_active' => true,
        ]);

        $paymentMethod = PaymentMethod::create([
            // Base
            'name' => 'Test payment method',
            'provider' => 'payment_provider'
        ]);

        $shippingMethod = ShippingMethod::create([
            // Base
            'name' => 'Test shipping method',
            'provider' => 'shipping_provider'
        ]);

        $order = Order::make([
            'comment' => 'Test order comment',
            'phone' => '+380989242645',
            'track' => '#2000000000000000000',
        ]);

        $order->status = $status;
        $order->payment_method = $paymentMethod;
        $order->shipping_method = $shippingMethod;
        $order->save();
    }
}