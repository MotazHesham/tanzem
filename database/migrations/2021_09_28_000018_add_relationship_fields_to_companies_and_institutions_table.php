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
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id', 'specialization_fk_4987516')->references('id')->on('specializations');
        });
    }
}
