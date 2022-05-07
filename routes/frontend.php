<?php


Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function(){
    
    Route::get('/','HomeController@home')->name('home'); 
    Route::post('users/media', 'HomeController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'HomeController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('register/company', 'HomeController@register_company')->name('register.company');
    Route::get('register/cader', 'HomeController@cader_register')->name('cader_register');
    Route::post('register/cader', 'HomeController@register_cader')->name('register.cader');
    Route::get('register/visitor', 'HomeController@visitor_register')->name('visitor_register');
    Route::post('register/visitor', 'HomeController@register_visitor')->name('register.visitor');

    Route::get('news/{id}','HomeController@news')->name('news');
    
    Route::get('terms/{id}', 'HomeController@terms')->name('terms');

    Route::post('subscription','HomeController@subscription')->name('subscription');
    
    // organizations
    Route::get('organizations','OrganizationsController@organizations')->name('organizations');
    Route::get('organizations/{id}','OrganizationsController@organization')->name('organization');
    
    // events
    Route::get('events','EventsController@events')->name('events');
    Route::get('events/{id}','EventsController@event')->name('event');
    
    // activites
    // Route::get('activties','ActivtiesController@activties')->name('activties');
    // Route::get('activity/{id}','ActivtiesController@activity')->name('activity');
    
    // caders
    Route::get('caders','CadersController@caders')->name('caders');
    Route::get('caders/{id}','CadersController@cader')->name('cader');   
    
    Route::get('contactus','ContactUsController@contactus')->name('contactus');
    Route::post('contactus/store','ContactUsController@store')->name('contactus.store'); 

    Route::post('rate','EventsController@rate')->name('event.rate');
});