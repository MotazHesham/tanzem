<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVisitorsFamiliesTable extends Migration
{
    public function up()
    {
        Schema::table('visitors_families', function (Blueprint $table) {
            $table->unsignedBigInteger('visitor_id');
            $table->foreign('visitor_id', 'visitor_fk_5160039')->references('id')->on('visitors');
        });
    }
}
