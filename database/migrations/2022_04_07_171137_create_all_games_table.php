<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idKorisnika')->unsigned();
            $table->bigInteger('idIgre')->unsigned();
            $table->integer('dobitak');
            $table->timestamps();

            $table->index('idKorisnika');
            $table->index('idIgre');

            $table->foreign('idKorisnika')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idIgre')->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_games');
    }
};
