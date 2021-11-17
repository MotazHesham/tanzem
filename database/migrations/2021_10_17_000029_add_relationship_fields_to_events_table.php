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
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_fk_5352128')->references('id')->on('clients');
            $table->unsignedBigInteger('government_id');
            $table->foreign('government_id', 'government_fk_5352130')->references('id')->on('governmental_entities');
        });
    }
}
