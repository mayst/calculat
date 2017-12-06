<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('personal_info', function (Blueprint $table) {

            $table->integer('id')->unique();
            $table->integer('user_id')->nullable();
            $table->string('male')->default('man');
            $table->date('age')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('zodiac')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('body_type')->nullable();
            $table->string('eyes_color')->nullable();
            $table->string('skin_color')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('children')->nullable();
            $table->string('attitude_to_alcohol')->nullable();
            $table->string('attitude_to_smoking')->nullable();
            $table->string('religious_views')->nullable();
            $table->text('about_me')->nullable();
            $table->text('my_desire')->nullable();
            $table->string('education')->nullable();
            $table->string('job')->nullable();
            $table->string('position')->nullable();
            $table->string('i_live')->nullable();
            $table->string('my_priorities')->nullable();
            $table->string('hobby')->nullable();
            $table->string('love_too')->nullable();
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
