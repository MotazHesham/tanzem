<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSpecializationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_specialization', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_id_fk_4987491')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id', 'specialization_id_fk_4987491')->references('id')->on('specializations')->onDelete('cascade');
        });
    }
}
