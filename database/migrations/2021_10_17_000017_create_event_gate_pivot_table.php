<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventGatePivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_gate', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_5137905')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('gate_id');
            $table->foreign('gate_id', 'gate_id_fk_5137905')->references('id')->on('gates')->onDelete('cascade');
        });
    }
}
