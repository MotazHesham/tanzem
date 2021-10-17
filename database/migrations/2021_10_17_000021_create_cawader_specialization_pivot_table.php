<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCawaderSpecializationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cawader_specialization', function (Blueprint $table) {
            $table->unsignedBigInteger('cawader_id');
            $table->foreign('cawader_id', 'cawader_id_fk_4988051')->references('id')->on('cawaders')->onDelete('cascade');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id', 'specialization_id_fk_4988051')->references('id')->on('specializations')->onDelete('cascade');
        });
    }
}
