<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id', 'city_fk_5137726')->references('id')->on('cities');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id', 'company_fk_5137722')->references('id')->on('companies_and_institutions');
        });
    }
}
