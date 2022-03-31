<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1/user', 'as' => 'api.', 'namespace' => 'Api\V1\User', 'middleware' => 'changelanguage'], function () {

    Route::post('register','UserAuthApiController@register');
    Route::post('login','UserAuthApiController@login');

    //send_sms_code
    Route::post('send_sms','UserAuthApiController@send_sms_code');

    //forgetpassword
    Route::post('forgetpassword','ForgetPasswordController@create_token');
    Route::post('forgetpassword/reset','ForgetPasswordController@reset');

    Route::post('login','UserAuthApiController@login');

    Route::post('contactus','UsersApiController@contactus');

    Route::group(['middleware' => ['auth:sanctum']],function () {

        Route::post('fcm-token','UsersApiController@update_fcm_token');

        // myEvents
        Route::get('myevents','EventsApiController@myevents');

        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile');
            Route::post('update','UsersApiController@update');
            Route::post('update_password','UsersApiController@update_password');
        });

        // visitor_familiies
        Route::group(['prefix' =>'visitor_families'],function(){
            Route::get('/','VisitorsFamiliesApiController@index') ;
            Route::post('add','VisitorsFamiliesApiController@store') ;
            Route::get('delete/{specialization_id}','VisitorsFamiliesApiController@delete') ;
        });

        // events
        Route::group(['prefix' =>'events'],function(){
            Route::get('/','EventsApiController@index') ;
            // Route::get('search/{search}','EventsApiController@search') ;
            Route::post('join','EventsApiController@join') ;
            Route::post('leave','EventsApiController@leave') ;
        });

        // notifications
        Route::get('notifications','NotificationsApiController@index');

    });
});



