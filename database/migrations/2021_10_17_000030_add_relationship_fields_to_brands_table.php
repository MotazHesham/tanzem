<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBrandsTable extends Migration
{
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_fk_5137859')->references('id')->on('events');
        });
    }
}
