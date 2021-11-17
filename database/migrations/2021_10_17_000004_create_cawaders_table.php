<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCawadersTable extends Migration
{
    public function up()
    {
        Schema::create('cawaders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dob');
            $table->string('degree');
            $table->integer('working_hours');
            $table->string('identity_number');
            $table->longText('desceiption')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
