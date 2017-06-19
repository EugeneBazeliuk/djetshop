<?php namespace Djetson\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('djetshop_currencies', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Base
            $table->string('name');
            $table->string('code')->unique();
            $table->string('symbol');
            $table->string('symbol_position');
            $table->boolean('symbol_space')->default(0);
            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('djetshop_currencies');
    }
}