<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatesTable extends Migration
{
    public function up()
    {
        Schema::create('gates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gate');
            $table->longText('description')->nullable();
            $table->string('zone_name');
            $table->decimal('latitude', 15, 2);
            $table->decimal('longitude', 15, 2);
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_5137888')->references('id')->on('events');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
