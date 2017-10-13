<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        // Create properties table
        Schema::create('djetshop_properties', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            // Base
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            // Relations
            $table->integer('group_id')->unsigned()->nullable();
            // Sortable
            $table->integer('sort_order')->default(0);
            // States
            $table->boolean('is_active')->default(false);
            // Reference

        });

        // Create property groups table
        Schema::create('djetshop_property_groups', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            // Base
            $table->increments('id');
            $table->string('name');
            // Sortable
            $table->integer('sort_order')->default(0);
        });

        // Create property values table
        Schema::create('djetshop_property_values', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            // Base
            $table->increments('id');
            $table->string('value');
            // Relations
            $table->integer('property_id')->unsigned()->nullable();
            // Reference
            $table->foreign('property_id')->references('id')->on('djetshop_properties');
        });

        // Create primary table product > property
        Schema::create('djetshop_products_properties', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('product_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('property_value_id')->unsigned()->nullable();
            $table->primary(['product_id', 'property_id'], 'product_property');
            $table->foreign('product_id')->references('id')->on('djetshop_products');
            $table->foreign('property_id')->references('id')->on('djetshop_properties');
        });

        // Add property group reference
        Schema::table('djetshop_properties', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('djetshop_property_groups');
        });
    }

    public function down()
    {
        // Delete property group references
        Schema::table('djetshop_properties', function(Blueprint $table) {
            $table->dropForeign('djetshop_properties_group_id_foreign');
        });
        Schema::dropIfExists('djetshop_products_properties');
        Schema::dropIfExists('djetshop_property_groups');
        Schema::dropIfExists('djetshop_property_values');
        Schema::dropIfExists('djetshop_properties');
    }
}