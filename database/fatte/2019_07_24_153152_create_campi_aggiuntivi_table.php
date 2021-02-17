<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampiAggiuntiviTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campi_aggiuntivi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('residenza_via',200);
            $table->string('residenza_cap',10);
            $table->string('residenza_numero_civico',10);
            $table->string('residenza_citta',40);
            $table->smallInteger('residenza_provincia');
            $table->smallInteger('residenza_nazione');
            $table->string('telefono',40);
            $table->string('ragione_sociale',200);
            $table->string('partita_iva',50);
             $table->string('azienda_via',200);
            $table->string('azienda_cap',10);
            $table->string('azienda_numero_civico',10);
            $table->string('azienda_citta',40);
            $table->smallInteger('azienda_provincia');
            $table->smallInteger('azienda_nazione');
            $table->string('facebook',50);
            $table->integer('facebook_like');
            $table->string('twitter',50);
            $table->integer('twitter_follower');
            $table->string('youtube',50);
            $table->integer('youtube_iscritti');
            $table->string('blog',150);
            $table->integer('blog_utenti');
            $table->integer('blog_visulizzazioni');
            $table->integer('mailing_list');
            $table->decimal('mailing_list_aperture',8,2);
            $table->decimal('mailing_list_click',8,2);
            $table->integer('giornale_tiratura');
            $table->string('giornale_periodo',50);
            $table->string('giornale_area',50);
            $table->integer('negozio_metri');
            $table->string('negozio_area',50);
            $table->string('negozio_posizione',50);
            $table->integer('negozio_clienti');
            $table->integer('eventi_numero');
            $table->integer('eventi_partecipanti');
            $table->boolean('vip');
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
        Schema::dropIfExists('campi_aggiuntivi');
    }
}
