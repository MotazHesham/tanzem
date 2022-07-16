<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6657388')->references('id')->on('users');
            $table->unsignedBigInteger('review_id')->nullable();
            $table->foreign('review_id', 'review_fk_6657467')->references('id')->on('event_review');
            $table->timestamps();
        });
    }
}
