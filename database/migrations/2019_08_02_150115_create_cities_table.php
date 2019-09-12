<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('activity');
            $table->timestamp('timesStart')->nullable();
            $table->timestamp('timesEnd')->nullable();

            $table->string('fileCartaIntecao')->nullable();
            $table->string('fileTermoCooperacao')->nullable();
            $table->string('fileTermoAditivo')->nullable();
            $table->string('statusInicioAtividades')->default('e');
            $table->timestamp('timeInicioAtividades')->nullable();

            $table->string('statusFormaEstagios')->default('p');
            $table->timestamp('timesFormaEstagios')->nullable();

            $table->string('fileGrupoLocal')->nullable();
            $table->string('fileConvite')->nullable();
            $table->string('fileAta')->nullable();
            $table->string('status1Apresentacao')->default('p');
            $table->timestamp('times1Apresentacao')->nullable();

            $table->string('fileApresentacao')->nullable();
            $table->string('fileDescObjetivo')->nullable();
            $table->string('fileMobilidade')->nullable();
            $table->string('filePoliticaNasc')->nullable();
            $table->string('fileBaseConsti')->nullable();
            $table->string('fileInvestimentos')->nullable();
            $table->string('fileMeioAmbiente')->nullable();
            $table->string('fileHistorico')->nullable();
            $table->string('fileDistribuicao')->nullable();
            $table->string('fileTerritorio')->nullable();
            $table->string('fileCaracterizacao')->nullable();
            $table->string('fileAtrativos')->nullable();
            $table->string('fileDesenvolvimentos')->nullable();
            $table->string('fileFrota')->nullable();
            $table->string('fileLinhas')->nullable();
            $table->string('fileJustificativa')->nullable();
            $table->string('fileObjetivo')->nullable();
            $table->string('fileMetodologia')->nullable();
            $table->string('statusProduto1')->default('p');
            $table->timestamp('timesProduto1')->nullable();

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
        Schema::dropIfExists('cities');
    }
}
