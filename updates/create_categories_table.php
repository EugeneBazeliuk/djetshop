<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        // Create categories table
        Schema::create('djetshop_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            // Base
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            // Meta
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            // NestedTree
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            // States
            $table->boolean('is_active')->default(0);
            $table->boolean('is_searchable')->default(0);
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });

        // Create primary table product > category
        Schema::create('djetshop_products_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['product_id', 'category_id'], 'product_category');
            // Reference
            $table->foreign('product_id')->references('id')->on('djetshop_products');
            $table->foreign('category_id')->references('id')->on('djetshop_categories');
        });

        // Add product category reference
        Schema::table('djetshop_products', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('djetshop_categories');
        });
    }

    public function down()
    {
        Schema::table('djetshop_products', function(Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('djetshop_products_categories');
        Schema::dropIfExists('djetshop_categories');
    }
}