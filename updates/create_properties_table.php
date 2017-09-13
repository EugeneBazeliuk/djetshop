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
            // Sortable
            $table->integer('sort_order')->default(0);
            // States
            $table->boolean('is_active')->default(0);
        });

        // Property Values
        Schema::create('djetshop_property_values', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('property_id')->unsigned()->nullable();
            $table->string('value');
            $table->foreign('property_id')->references('id')->on('djetshop_properties');
        });

        // Property Groups
        Schema::create('djetshop_property_groups', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            // Sortable
            $table->integer('sort_order')->default(0);
        });

        // Add property group reference to properties
        Schema::table('djetshop_properties', function(Blueprint $table) {
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('djetshop_property_groups');
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_property_values');
        Schema::dropIfExists('djetshop_properties');
        Schema::dropIfExists('djetshop_property_groups');
    }
}
