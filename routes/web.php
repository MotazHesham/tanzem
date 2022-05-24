<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

//Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');

Route::post('code/send','CodeController@send')->name('code.send');
Route::post('code/verify','CodeController@verify')->name('code.verify');

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::post('events/partials/supervisor', 'EventsController@partials_supervisor')->name('events.partials.supervisor');
    Route::post('events/partials/zoominmap', 'EventsController@partials_zoominmap')->name('events.partials.zoominmap');
    Route::post('events/partials/attendance_cader', 'EventsController@partials_attendance_cader')->name('events.partials.attendance_cader');
    Route::post('events/partials/cader_break', 'EventsController@partials_cader_break')->name('events.partials.cader_break');
    Route::get('events/partials/cader_break_status/{id}/{status}', 'EventsController@partials_cader_break_status')->name('events.partials.cader_break_status');
    Route::get('events/status/{id}/{status}', 'EventsController@changeStatus')->name('events.status');
    Route::get('event/{id}/cawders', 'EventsController@choose_cawder')->name('events.choose_cawder');
    Route::post('event/cawders/add', 'EventsController@save_cawder')->name('events.save_cawder');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth','staff']], function () {


    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/update_approved', 'UsersController@update_approved')->name('users.update_approved');
    Route::resource('users', 'UsersController');


    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Governmental Entities
    Route::delete('governmental-entities/destroy', 'GovernmentalEntitiesController@massDestroy')->name('governmental-entities.massDestroy');
    Route::resource('governmental-entities', 'GovernmentalEntitiesController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Specialization
    Route::delete('specializations/destroy', 'SpecializationController@massDestroy')->name('specializations.massDestroy');
    Route::resource('specializations', 'SpecializationController');

    // Companies And Institutions
    Route::delete('companies-and-institutions/destroy', 'CompaniesAndInstitutionsController@massDestroy')->name('companies-and-institutions.massDestroy');
    Route::post('companies-and-institutions/media', 'CompaniesAndInstitutionsController@storeMedia')->name('companies-and-institutions.storeMedia');
    Route::post('companies-and-institutions/ckmedia', 'CompaniesAndInstitutionsController@storeCKEditorImages')->name('companies-and-institutions.storeCKEditorImages');
    Route::resource('companies-and-institutions', 'CompaniesAndInstitutionsController');

    // Cawader
    Route::delete('cawaders/destroy', 'CawaderController@massDestroy')->name('cawaders.massDestroy');
    Route::resource('cawaders', 'CawaderController');
    Route::Post('cawaders/massApprove', 'CawaderController@massApprove')->name('cawaders.massApprove');


    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::resource('brands', 'BrandsController');

   // Gates
    Route::delete('gates/destroy', 'GatesController@massDestroy')->name('gates.massDestroy');
    Route::post('gates/media', 'GatesController@storeMedia')->name('gates.storeMedia');
    Route::post('gates/ckmedia', 'GatesController@storeCKEditorImages')->name('gates.storeCKEditorImages');
    Route::resource('gates', 'GatesController');
    // Visitors
    Route::delete('visitors/destroy', 'VisitorsController@massDestroy')->name('visitors.massDestroy');
    Route::resource('visitors', 'VisitorsController');

    // Visitors Families
    Route::delete('visitors-families/destroy', 'VisitorsFamiliesController@massDestroy')->name('visitors-families.massDestroy');
    Route::resource('visitors-families', 'VisitorsFamiliesController', ['except' => ['show']]);

    // Settings
    Route::resource('settings', 'SettingsController', ['except' => ['create', 'store', 'show', 'destroy']]);

    // Said About Tanzem
    Route::delete('said-about-tanzems/destroy', 'SaidAboutTanzemController@massDestroy')->name('said-about-tanzems.massDestroy');
    Route::post('said-about-tanzems/media', 'SaidAboutTanzemController@storeMedia')->name('said-about-tanzems.storeMedia');
    Route::post('said-about-tanzems/ckmedia', 'SaidAboutTanzemController@storeCKEditorImages')->name('said-about-tanzems.storeCKEditorImages');
    Route::resource('said-about-tanzems', 'SaidAboutTanzemController');

    // Contactus
    Route::delete('contactus/destroy', 'ContactusController@massDestroy')->name('contactus.massDestroy');
    Route::resource('contactus', 'ContactusController');

    // News
    Route::get('news/status/{id}/{status}', 'NewsController@changeStatus')->name('news.status');
    Route::delete('news/destroy', 'NewsController@massDestroy')->name('news.massDestroy');
    Route::post('news/media', 'NewsController@storeMedia')->name('news.storeMedia');
    Route::post('news/ckmedia', 'NewsController@storeCKEditorImages')->name('news.storeCKEditorImages');
    Route::resource('news', 'NewsController');

    // Subscription
    Route::delete('subscriptions/destroy', 'SubscriptionController@massDestroy')->name('subscriptions.massDestroy');
    Route::resource('subscriptions', 'SubscriptionController');

    // Important Links
    Route::delete('important-links/destroy', 'ImportantLinksController@massDestroy')->name('important-links.massDestroy');
    Route::resource('important-links', 'ImportantLinksController');

    // Break Types
    Route::delete('break-types/destroy', 'BreakTypesController@massDestroy')->name('break-types.massDestroy');
    Route::resource('break-types', 'BreakTypesController');

    // Cawader Specialization
    Route::delete('cawader-specializations/destroy', 'CawaderSpecializationController@massDestroy')->name('cawader-specializations.massDestroy');
    Route::resource('cawader-specializations', 'CawaderSpecializationController');
   // Slider
   Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
   Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
   Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
   Route::resource('sliders', 'SliderController');

   // Skills
   Route::delete('skills/destroy', 'SkillsController@massDestroy')->name('skills.massDestroy');
   Route::resource('skills', 'SkillsController');

   // Rate
   Route::delete('rates/destroy', 'RateController@massDestroy')->name('rates.massDestroy');
   Route::resource('rates', 'RateController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
