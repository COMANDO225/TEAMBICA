<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_cursos', function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });



        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('contenido');
            // $table->integer('precio');
            $table->string('imagen');
            $table->foreignId('user_id')->references('id')->on('users')->comment('El usuario que creo el curso');
            $table->foreignId('categoria_id')->references('id')->on('categoria_cursos')->comment('La categoria del curso');
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
        Schema::dropIfExists('categoria_curso');
        Schema::dropIfExists('cursos');
    }
}
