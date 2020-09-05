<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('adresse');
            $table->string('email');
            $table->integer('telephone');
            $table->decimal("salaire",8,2);
            $table->string('nomEntreprise')->nullable();
            $table->unsignedBigInteger('typeclient')->nullable();
            $table->unsignedBigInteger('employeur_id')->nullable();
            $table->foreign('typeclient')->references('id')->on('type_clients')->onDelete('cascade');
            $table->foreign('employeur_id')->references('id')->on('employeurs')->onDelete('cascade');
            $table->timestamp('deleted_at');

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
        Schema::dropIfExists('clients');
    }
}
