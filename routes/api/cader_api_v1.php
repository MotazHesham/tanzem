<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1/cader', 'as' => 'api.', 'namespace' => 'Api\V1\Cader', 'middleware' => 'changelanguage'], function () {

    Route::post('login','UserAuthApiController@login');
    Route::post('register','UserAuthApiController@register');

    // settings
    Route::get('specializations','UsersApiController@specializations');
    Route::get('skills','UsersApiController@skills');
    Route::get('cities','UsersApiController@cities');
    Route::get('degrees','UsersApiController@degrees');
    Route::get('breaks_type','UsersApiController@breaks_type');
    Route::Post('terms','UsersApiController@terms');

    Route::group(['middleware' => ['auth:sanctum']],function () {

        Route::post('fcm-token','UsersApiController@update_fcm_token');

        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile');
            Route::post('update','UsersApiController@update');
            Route::post('update_password','UsersApiController@update_password');
        });

        //attendance
        Route::post('attend','EventApiController@attend') ;

        //break
        Route::post('break/request','EventApiController@break_request') ;
        Route::post('break/cancel','EventApiController@break_cancel') ;

        Route::get('current_event','EventApiController@current_event') ;
        Route::get('prev_events','EventApiController@prev_events') ;
        Route::get('now_events','EventApiController@now_events') ;

        Route::get('event/{event_id}','EventApiController@event') ;
        Route::Post('event_status','EventApiController@changeStatus') ;

        //get_Cader_notification
        Route::get('all_notification','UsersApiController@MyNotifications') ;

    });
});



