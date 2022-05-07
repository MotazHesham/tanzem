<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCawaderSkillPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cawader_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('cawader_id');
            $table->foreign('cawader_id', 'cawader_id_fk_6461548')->references('id')->on('cawaders')->onDelete('cascade');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id', 'skill_id_fk_6461548')->references('id')->on('skills')->onDelete('cascade');
        });
    }
}
