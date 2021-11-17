<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventVisitorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_visitor', function (Blueprint $table) {
            $table->unsignedBigInteger('visitor_id');
            $table->foreign('visitor_id', 'visitor_id_fk_5137955')->references('id')->on('visitors')->onDelete('cascade');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_5137955')->references('id')->on('events')->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }
}
