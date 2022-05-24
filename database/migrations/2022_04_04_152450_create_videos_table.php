<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('Titulo_Original', 255);
            $table->string('Titulo_en_Mexico', 255);
            $table->string('Nombre_del_Director', 255);
            $table->string('Guion', 255);
            $table->string('Actor_Principal', 255);
            $table->string('Actriz_Principal', 255);
            $table->string('Pais_de_Produccion', 255);
            $table->string('Anio_de_Produccion', 255);
            $table->integer('Duracion_en_Minutos');
            $table->string('Genero', 255);
            $table->string('Numero_en_Archivo', 255);
            $table->string('Formato', 255);
            $table->string('Subtitulo', 255);
            $table->string('Presentacion', 255);
            $table->string('Forma_de_Copiado', 255);
            $table->string('Fecha_de_Ingreso', 255);
            $table->string('Password',255);
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
        Schema::dropIfExists('videos');
    }
}
