<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->string('uuid', 15)->comment('代號');
            $table->string('name', 50)->comment('品名');
            $table->string('description')->comment('描述')->nullable();
            $table->integer('group_id')->unsigned()->comment('群組');
            $table->string('unit')->comment('單位');
            $table->string('status')->comment('狀態');
            $table->timestamps();

            $table->unique([ 'uuid' ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
