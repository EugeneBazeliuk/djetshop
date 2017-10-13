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
            // Base
            $table->increments('id');
            $table->string('phone')->nullable();
            $table->string('track')->nullable();
            $table->text('comment')->nullable();
            $table->json('shipping_address')->nullable();
            $table->json('billing_address')->nullable();
            // Totals
            $table->decimal('sub_total', 10, 2)->nullable();
            $table->decimal('payment_total', 10, 2)->nullable();
            $table->decimal('shipping_total', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            // Relation
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->integer('manager_id')->unsigned()->nullable();
            $table->foreign('manager_id')->references('id')->on('backend_users');
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->integer('shipping_method_id')->unsigned()->nullable();
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });





//        Schema::create('djetshop_order_items', function(Blueprint $table) {
//            $table->engine = 'InnoDB';
//            $table->increments('id');
//            $table->integer('order_id')->unsigned()->nullable();
//            $table->integer('product_id')->unsigned()->nullable();
//            $table->integer('product_id')->unsigned()->nullable();
//            $table->integer('quantity')->default(0);
//            $table->decimal('price', 10, 2)->default(0.00);
//            $table->timestamps();
//        });

//        Schema::create('djetshop_order_statuses', function(Blueprint $table) {
//            $table->engine = 'InnoDB';
//            $table->increments('id');
//            $table->integer('order_id')->unsigned();
//            $table->timestamps();
//        });
//
//        Schema::create('djetshop_order_histories', function(Blueprint $table) {
//            $table->engine = 'InnoDB';
//            $table->increments('id');
//            $table->text('message')->nullable();
//            $table->integer('order_id')->unsigned()->nullable();
//            $table->integer('manager_id')->unsigned()->nullable();
//            $table->timestamps();
//        });


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
        Schema::dropIfExists('djetshop_orders');
    }
}