<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesAndInstitutionSpecializationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('companies_and_institution_specialization', function (Blueprint $table) {
            $table->unsignedBigInteger('companies_and_institution_id');
            $table->foreign('companies_and_institution_id', 'companies_and_institution_id_fk_4994297')->references('id')->on('companies_and_institutions')->onDelete('cascade');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id', 'specialization_id_fk_4994297')->references('id')->on('specializations')->onDelete('cascade');
        });
    }
}
