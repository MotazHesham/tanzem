<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCawadersTable extends Migration
{
    public function up()
    {
        Schema::table('cawaders', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id', 'city_fk_4988049')->references('id')->on('cities');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4994749')->references('id')->on('users');
            $table->unsignedBigInteger('companies_and_institution_id')->nullable();
            $table->foreign('companies_and_institution_id', 'companies_and_institution_fk_4994786')->references('id')->on('companies_and_institutions');
        });
    }
}
