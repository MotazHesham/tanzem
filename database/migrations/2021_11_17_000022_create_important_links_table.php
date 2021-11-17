<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportantLinksTable extends Migration
{
    public function up()
    {
        Schema::create('important_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text');
            $table->string('link');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
