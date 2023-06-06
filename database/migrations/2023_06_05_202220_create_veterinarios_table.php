<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeterinariosTable extends Migration
{
    public function up()
    {
        Schema::create('veterinarios', function (Blueprint $table) {
            $table->id();
            $table->integer('crmv');
            $table->string('nome');
            $table->unsignedBigInteger('especialidade_id')->references('id')->on('especialidades');
            $table->softDeletes();
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
        Schema::dropIfExists('veterinarios');
    }
}
