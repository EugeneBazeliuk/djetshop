<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('djetson_shop_payment_methods', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Base
            $table->string('name');
            $table->string('provider');
            $table->decimal('cost', 10, 2)->nullable();
            // State
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetson_shop_payment_methods');
    }
}
