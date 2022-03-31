<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVisitorsTable extends Migration
{
    public function up()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5137953')->references('id')->on('users');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id', 'visitor_fk_5122953')->references('id')->on('visitors');
        });
    }
}
