<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComuniCampagne extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comuni_campagne', function (Blueprint $table) {
            $table->integer('comuni_id')->unsigned();
            $table->bigInteger('campagna_id')->unsigned();
            $table->foreign('comuni_id')->references('id')->on('comuni')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('campagna_id')->references('id')->on('campagne')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('comuni_campagne', function (Blueprint $table) {
            //
        });
    }

}
