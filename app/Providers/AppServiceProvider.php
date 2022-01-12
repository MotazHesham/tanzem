<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('start_date_check', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            $start_date = strtotime(Carbon::createFromFormat(config('panel.date_format'), $inputs['start_date'])->format('Y-m-d'));
            $end_date = strtotime(Carbon::createFromFormat(config('panel.date_format'), $inputs['end_date'])->format('Y-m-d'));
            $result = true;
            if ($end_date < $start_date) {
                $result = false;
            }
            return $result;
        });
        Validator::extend('start_time_check', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            $start_time = strtotime(Carbon::createFromFormat(config('panel.time_format'), $inputs['start_time'])->format('H:i:s'));
            $end_time = strtotime(Carbon::createFromFormat(config('panel.time_format'), $inputs['end_time'])->format('H:i:s'));
            $result = true;
            if ($end_time < $start_time) {
                $result = false;
            }
            return $result;
        });
        Schema::defaultStringLength(191);
    }
}
