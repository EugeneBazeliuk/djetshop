<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('djetshop_products', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('ean_13')->nullable();
            $table->string('isbn')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->double('package_width', 10, 2)->nullable()->default(0.00);
            $table->double('package_height', 10, 2)->nullable()->default(0.00);
            $table->double('package_depth', 10, 2)->nullable()->default(0.00);
            $table->double('package_weight', 10, 2)->nullable()->default(0.00);
            // States
            $table->boolean('is_active')->default(0);
            $table->boolean('is_searchable')->default(0);
            $table->boolean('is_unique_text')->default(0);
            // SoftDelete
            $table->softDeletes();
            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_products');
    }
}