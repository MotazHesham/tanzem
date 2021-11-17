<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventReviewPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_review', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_5352084')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('visitor_id');
            $table->foreign('visitor_id', 'visitor_id_fk_5352084')->references('id')->on('visitors')->onDelete('cascade');
            $table->text('review');
            $table->decimal('rate', 15, 2);
            $table->timestamps();
        });
    }
}
