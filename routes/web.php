<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('login', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});


Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/owners','HomeController@owners')->name('owners');
Route::get('/house/{house}','HomeController@house')->name('house');
Route::post('/booking','HomeController@booking')->name('booking');
Route::post('/subscribe','HomeController@subscribe')->name('subscribe');

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Houses
    Route::delete('houses/destroy','HouseController@massDestroy')->name('houses.massDestroy');
    Route::post('houses/media', 'HouseController@storeMedia')->name('houses.storeMedia');
    Route::post('houses/ckmedia', 'HouseController@storeCKEditorImages')->name('houses.storeCKEditorImages');
    Route::resource('houses', 'HouseController');


    // Bookings

    Route::delete('bookings/destroy', 'BookingController@massDestroy')->name('bookings.massDestroy');
    Route::resource('bookings', 'BookingController');

    // Days
    Route::delete('days/desctroy','DayController@massDestroy')->name('days.massDestroy');
    Route::resource('days', 'DayController');

    // Infrastructures
    Route::delete('infrastructures/destroy','InfrastructureController@massDestroy')->name('infrastructures.massDestroy');
    Route::post('infrastructures/media', 'InfrastructureController@storeMedia')->name('infrastructures.storeMedia');
    Route::resource('infrastructures', 'InfrastructureController');

    // Task Statuses
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    //  Companies
    Route::resource('companies', 'CompanyController');

    // Contacts
    Route::resource('contacts', 'ContactController');

    // Subscribers
    Route::delete('subscribers/destroy','BookingController@massDestroy')->name('subscribers.massDestroy');
    Route::resource('subscribers', 'SubscriberController');
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

Route::get('contact','MessageController@index')->name('contact');
Route::post('/contact','MessageController@store');
