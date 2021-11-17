<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompaniesAndInstitutionsTable extends Migration
{
    public function up()
    {
        Schema::table('companies_and_institutions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4987515')->references('id')->on('users'); 
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id', 'city_fk_5346419')->references('id')->on('cities');
        });
    }
}
