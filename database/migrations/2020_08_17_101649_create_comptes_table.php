<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('numero');
            $table->string('cleRib');
            $table->date('date');
            $table->boolean('etat');
            $table->decimal("solde", 8, 2);
            $table->decimal("frais", 8, 2);
            $table->unsignedBigInteger("type_compte_id");
            $table->unsignedBigInteger("client_id");
            $table->foreign('type_compte_id')->references('id')->on('type_comptes')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');    
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
        Schema::dropIfExists('comptes');
    }
}
