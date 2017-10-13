<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBindingsTable extends Migration
{
    public function up()
    {
        // Create binding types table
        Schema::create('djetshop_binding_types', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            // Base
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            // Timestamps
            $table->timestamps();
        });

        // Create bindings table
        Schema::create('djetshop_bindings', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            // Base
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            // Meta
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            // Relations
            $table->integer('type_id')->unsigned()->nullable();
            // States
            $table->boolean('is_active')->default(0);
            $table->boolean('is_searchable')->default(0);
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
            // Reference
            $table->foreign('type_id')->references('id')->on('djetshop_binding_types');
        });

        // Create primary table product > binding
        Schema::create('djetshop_products_bindings', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('product_id')->unsigned();
            $table->integer('binding_id')->unsigned();
            $table->primary(['product_id', 'binding_id'], 'product_binding');
            // Reference
            $table->foreign('product_id')->references('id')->on('djetshop_products');
            $table->foreign('binding_id')->references('id')->on('djetshop_bindings');
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_products_bindings');
        Schema::dropIfExists('djetshop_bindings');
        Schema::dropIfExists('djetshop_binding_types');
    }
}