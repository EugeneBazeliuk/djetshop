<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('djetshop_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Base
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('description')->nullable();
            // NestedTree
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            // States
            $table->boolean('is_active')->default(0);
            $table->boolean('is_searchable')->default(0);
            // SoftDelete
            $table->softDeletes();
            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_categories');
    }
}