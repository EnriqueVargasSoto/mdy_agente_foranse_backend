<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->string('sistemaOperativo');
            $table->string('procesador');
            $table->string('ram');
            $table->string('mac');
            $table->string('ipPublica');
            $table->string('ipPrivada');
            $table->string('ubicacionGeografica');
            $table->string('idPc');
            $table->string('nombre');
            $table->string('tipo');
            $table->string('cliente');
            $table->string('hostname');
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
        Schema::dropIfExists('trackings');
    }
}
