<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email_1');
            $table->string('email_2')->nullable();
            $table->string('facebook')->nullable();
            $table->string('gmail')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('home_text_1')->nullable();
            $table->longText('home_text_2')->nullable();
            $table->longText('about_us');
            $table->longText('caders_text')->nullable();
            $table->longText('events_text')->nullable();
            $table->longText('news_text')->nullable();
            $table->longText('how_we_work_header')->nullable();
            $table->longText('how_we_work_1')->nullable();
            $table->longText('how_we_work_2')->nullable();
            $table->longText('how_we_work_3')->nullable();
            $table->longText('said_about_tanzem')->nullable();
            $table->longText('organizers_text')->nullable();
            $table->longText('contact_us_text')->nullable();
            $table->longText('contact_us_text_2')->nullable();
            $table->longText('goals')->nullable();
            $table->longText('terms_cawader')->nullable();
            $table->longText('terms_company')->nullable();
            $table->longText('terms_visitor')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
