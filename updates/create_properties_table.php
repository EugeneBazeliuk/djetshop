<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('djetshop_properties', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Base
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            // States
            $table->boolean('is_active')->default(0);
        });

        Schema::create('djetshop_property_values', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('property_id')->unsigned()->nullable();
            $table->string('value');
            //$table->foreign('property_id')->references('id')->on('djetshop_properties');
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_property_values');
        Schema::dropIfExists('djetshop_properties');
    }
}
