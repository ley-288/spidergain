<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategorieUtent extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('categorie_utenti', function (Blueprint $table) {
            $table->integer('categoria_id')->unsigned();
            $table->bigInteger('utente_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorie')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('utente_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('categorie_utenti', function (Blueprint $table) {
            //
        });
    }

}
