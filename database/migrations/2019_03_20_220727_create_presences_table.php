<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
            $table->time('check_in');
            $table->time('check_out')->nullable();
            $table->string('loc_x', 30)->nullable();
            $table->string('loc_y', 30)->nullable();
            $table->string('loc_c', 50)->nullable();
            $table->string('loc_x_o', 30)->nullable();
            $table->string('loc_y_o', 30)->nullable();
            $table->string('loc_c_o', 50)->nullable();
            $table->integer('status')->default(0);
            $table->integer('conf_i')->default(0);
            $table->integer('conf_o')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presences');
    }
}
