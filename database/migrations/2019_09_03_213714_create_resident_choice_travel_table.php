<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentChoiceTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_choice_travel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned()->index();
            $table->foreign('visitor_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('resident_id')->unsigned()->index();
            $table->foreign('resident_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('statues')->default(1);
            $table->integer('finish')->default(0);
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
        Schema::dropIfExists('resident_choice_travel');
    }
}
