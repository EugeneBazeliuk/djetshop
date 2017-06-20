<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOrderStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('djetshop_order_statuses', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Base
            $table->string('name');
            $table->string('color');
            // Relation to mail templates
            $table->integer('mail_template_id')->unsigned()->nullable();
            // States
            $table->boolean('is_active')->default(0);
            $table->boolean('is_send_email')->default(0);
            $table->boolean('is_attach_invoice')->default(0);
            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_order_statuses');
    }
}
