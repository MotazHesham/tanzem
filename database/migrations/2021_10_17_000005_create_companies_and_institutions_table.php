<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesAndInstitutionsTable extends Migration
{
    public function up()
    {
        Schema::create('companies_and_institutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('commerical_num');
            $table->date('commerical_expiry');
            $table->string('licence_num');
            $table->date('licence_expiry');
            $table->longText('about_company');
            $table->string('facebook')->nullable();
            $table->string('gmail')->nullable();
            $table->string('linked')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
