<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('zone_name');
            $table->decimal('latitude', 15, 2);
            $table->decimal('longitude', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
