<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('djetshop_orders', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Base
            $table->integer('manager_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            // Details
            $table->text('comment')->nullable();
            // Shipping
            $table->integer('shipping_method_id')->unsigned()->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0.00);
            $table->string('track_number')->nullable();
            // Payments
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->decimal('payment_cost', 10, 2)->default(0.00);
            // Totals
            $table->decimal('subtotal', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            // States
            $table->boolean('is_closed')->default(0);
            $table->boolean('is_paid')->default(0);
            // Timestamps
            $table->timestamps();
        });

        Schema::create('djetshop_order_items', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('sku');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('djetshop_order_statuses', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('djetshop_order_histories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('message')->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('manager_id')->unsigned()->nullable();
            $table->timestamps();
        });


        //
        // Reference
        //
//        Schema::table('djetshop_orders', function(Blueprint $table) {
//            $table->foreign('customer_id')->references('id')->on('users');
//            $table->foreign('manager_id')->references('id')->on('backend_users');
//            $table->foreign('order_status_id')->references('id')->on('djetshop_order_statuses');
//            $table->foreign('payment_method_id')->references('id')->on('djetshop_payment_methods');
//            $table->foreign('shipping_method_id')->references('id')->on('djetshop_shipping_methods');
//        });
//
//        Schema::table('djetshop_order_histories', function(Blueprint $table) {
//            $table->foreign('manager_id')->references('id')->on('backend_users');
//            $table->foreign('order_id')->references('id')->on('djetshop_orders');
//        });
//
//        Schema::table('djetshop_order_items', function(Blueprint $table) {
//            $table->foreign('order_id')->references('id')->on('djetshop_orders');
//            $table->foreign('product_id')->references('id')->on('djetshop_products');
//        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_order_histories');
        Schema::dropIfExists('djetshop_order_statuses');
        Schema::dropIfExists('djetshop_order_items');
        Schema::dropIfExists('djetshop_orders');
    }
}
