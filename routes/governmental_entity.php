<?php

Route::group(['prefix' => 'government', 'as' => 'government.', 'namespace' => 'GovernmentalEntity', 'middleware' => ['auth','government']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    
    // Events
    Route::get('events/status/{id}/{status}', 'EventsController@changeStatus')->name('events.status');
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::resource('brands', 'BrandsController');

    // Visitors
    Route::delete('visitors/destroy', 'VisitorsController@massDestroy')->name('visitors.massDestroy');
    Route::post('visitors/media', 'VisitorsController@storeMedia')->name('visitors.storeMedia');
    Route::post('visitors/ckmedia', 'VisitorsController@storeCKEditorImages')->name('visitors.storeCKEditorImages');
    Route::resource('visitors', 'VisitorsController');
    
    // Visitors Families
    Route::delete('visitors-families/destroy', 'VisitorsFamiliesController@massDestroy')->name('visitors-families.massDestroy');
    Route::resource('visitors-families', 'VisitorsFamiliesController', ['except' => ['show']]); 

    // News 
    Route::delete('news/destroy', 'NewsController@massDestroy')->name('news.massDestroy');
    Route::post('news/media', 'NewsController@storeMedia')->name('news.storeMedia');
    Route::post('news/ckmedia', 'NewsController@storeCKEditorImages')->name('news.storeCKEditorImages');
    Route::resource('news', 'NewsController');
    
});