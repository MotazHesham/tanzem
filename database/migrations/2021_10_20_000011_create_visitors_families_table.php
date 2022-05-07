<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('visitors_families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('gender');
            $table->string('relation');
            $table->string('phone');
            $table->string('identity')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
