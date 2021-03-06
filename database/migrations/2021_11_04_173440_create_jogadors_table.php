<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJogadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogador', function (Blueprint $table) {
            $table->increments('id');
			$table->string("nome", 100);
			$table->date("nascimento");
			$table->integer("clube")->unsigned();
			$table->integer("posicao")->unsigned();
			$table->foreign("clube")->references("id")->on("clube");
			$table->foreign("posicao")->references("id")->on("posicao");
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
        Schema::dropIfExists('jogador');
    }
}
