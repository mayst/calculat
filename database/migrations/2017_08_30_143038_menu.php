<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Menu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('menu', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->string('title');
            $table->timestamps();

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
