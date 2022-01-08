<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1/cader', 'as' => 'api.', 'namespace' => 'Api\V1\Cader', 'middleware' => 'changelanguage'], function () {

    Route::post('login','UserAuthApiController@login');
    
    Route::get('breaks_type','UsersApiController@breaks_type');

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
    });
});



