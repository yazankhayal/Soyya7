<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourismCompaniesGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourism_companies_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('tourism_companies_gallery/no.png');
            $table->integer('tourism_companies_id')->unsigned()->index();
            $table->foreign('tourism_companies_id')->references('id')->on('tourism_companies');
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
        Schema::dropIfExists('tourism_companies_gallery');
    }
}
