<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreenEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screen_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTracking'); // Columna para la clave foránea

            // Definir la clave foránea
            $table->foreign('idTracking') // Columna local
                  ->references('id')   // Columna en la tabla relacionada
                  ->on('trackings')        // Tabla relacionada
                  ->onDelete('no action'); // Acción al eliminar el usuario
            $table->string('objectName')->nullable();
            $table->string('url');
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
        Schema::dropIfExists('screen_events');
    }
}
