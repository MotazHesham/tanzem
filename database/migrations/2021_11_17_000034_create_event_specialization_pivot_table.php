<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSpecializationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_specialization', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_5352082')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id', 'specialization_id_fk_5352082')->references('id')->on('specializations')->onDelete('cascade');
        });
    }
}
