<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandVisitorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('brand_visitor', function (Blueprint $table) {
            $table->unsignedBigInteger('visitor_id');
            $table->foreign('visitor_id', 'visitor_id_fk_5137956')->references('id')->on('visitors')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id', 'brand_id_fk_5137956')->references('id')->on('brands')->onDelete('cascade');
        });
    }
}
