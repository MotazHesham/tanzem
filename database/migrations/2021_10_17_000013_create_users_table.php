<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->boolean('approved')->default(1)->nullable(); 
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('phone')->nullable();
            $table->string('landline_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('user_type');
            $table->boolean('health_status')->default(0)->nullable(); 
            $table->string('fcm_token',2000)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
