<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentStarTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_star_travel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned()->index();
            $table->foreign('visitor_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('resident_id')->unsigned()->index();
            $table->foreign('resident_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('star');
            $table->string('name');
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
        Schema::dropIfExists('resident_star_travel');
    }
}
