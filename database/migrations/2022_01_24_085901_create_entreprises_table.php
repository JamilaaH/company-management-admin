<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id('tva');
            $table->foreignId('user_id')->constrained();
            $table->string('nom');
            $table->string('activite');
            $table->string('adresse');
            $table->string('ville');
            $table->string('pays');
            $table->integer('code_postal');
            $table->string('email');
            $table->string('nom_contact');
            $table->bigInteger('numero_contact');
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
        Schema::dropIfExists('entreprises');
    }
}
