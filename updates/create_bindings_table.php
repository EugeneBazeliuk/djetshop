<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBindingsTable extends Migration
{
    public function up()
    {
        Schema::create('djetshop_bindings', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('description')->nullable();
            // States
            $table->boolean('is_active')->default(0);
            $table->boolean('is_searchable')->default(0);
            // SoftDelete
            $table->softDeletes();
            // Timestamps
            $table->timestamps();
        });

        Schema::create('djetshop_binding_types', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->timestamps();
        });

        Schema::table('djetshop_bindings', function(Blueprint $table) {
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('djetshop_binding_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_bindings');
        Schema::dropIfExists('djetshop_binding_types');
    }
}