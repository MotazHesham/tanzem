<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCawaderEventPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cawader_event', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_5352083')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('cawader_id');
            $table->foreign('cawader_id', 'cawader_id_fk_5352083')->references('id')->on('cawaders')->onDelete('cascade');
        });
    }
}
