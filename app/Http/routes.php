<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'auth', 'uses' => 'DefaultPageRouterController@forward']);
Route::get('/home', ['middleware' => 'auth', 'uses' => 'DefaultPageRouterController@forward']);

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/', ['uses' => 'ProfileController@index']);
    Route::post('updatePhoto', ['uses' => 'ProfileController@updatePhoto']);
    Route::post('updateCover', ['uses' => 'ProfileController@updateCover']);
    Route::post('updateInfo', ['uses' => 'ProfileController@updateInfo']);
    Route::get('photo', ['uses' => 'ProfileController@photo']);
    Route::get('cover', ['uses' => 'ProfileController@cover']);
    Route::get('myTeam', ['uses' => 'ProfileController@myTeam']);
});

// Authentication routes...
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', function () {
        dd('Coming Soon');
    });
});

// data and actions
Route::group(['prefix' => 'emp', 'middleware' => 'auth'], function () {
    Route::get('', ['middleware' => 'admin', 'uses' => 'EmployeeController@index']);
    Route::get('create', ['uses' => 'EmployeeController@create']);
    Route::get('countFind', ['uses' => 'EmployeeController@countFind']);
    Route::get('{id}/detail', ['uses' => 'EmployeeController@detail']);
    Route::get('{id}/edit', ['uses' => 'EmployeeController@edit']);
    Route::get('{id}/getForEdit', ['as' => 'emp-get', 'uses' => 'EmployeeController@getForEdit']);
    Route::get('list', ['as' => 'emp-list', 'uses' => 'EmployeeController@empList']);
    Route::post('create', ['as' => 'store-emp', 'uses' => 'EmployeeController@store']);
    Route::get('find', ['uses' => 'EmployeeController@find']);
});

Route::group(['prefix' => 'sales', 'middleware' => 'auth'], function () {
    Route::get('/', ['uses' => 'Sales\SalesController@index']);
    Route::get('create', ['uses' => 'Sales\SalesController@create']);

    Route::post('create', ['uses' => 'Sales\SalesController@store']);
    Route::post('process', ['uses' => 'Sales\SalesController@process']);
    Route::get('list', ['as' => 'sales-list', 'uses' => 'Sales\SalesController@salesList']);
    Route::get('{id}/detail', ['uses' => 'Sales\SalesController@detail']);
    Route::get('statuses', ['uses' => 'Sales\SalesController@statuses']);

    Route::get('/my/count/today', ['uses' => 'Sales\SalesController@myCountToday']);
    Route::get('/my/weekly-chart', ['uses' => 'Sales\SalesController@myWeeklyChart']);
});

Route::group(['prefix' => 'campaign', 'middleware' => 'auth'], function () {
    Route::get('list', ['uses' => 'CampaignController@campaignList']);
    Route::get('{campaignId}/products', ['uses' => 'CampaignController@products']);
});


Route::group(['prefix' => 'shift', 'middleware' => 'auth'], function () {
    Route::get('list', ['uses' => 'ShiftController@shiftList']);
});

Route::group(['prefix' => 'group', 'middleware' => 'auth'], function () {
    Route::get('list', ['uses' => 'GroupController@groupList']);
});

Route::group(['prefix' => 'post', 'middleware' => 'auth'], function () {
    Route::get('list', ['uses' => 'PostController@posts']);
    Route::get('{id}', ['uses' => 'PostController@find']);
    Route::post('create', ['uses' => 'PostController@store']);
});

// directives
Route::group(['prefix' => 'common', 'middleware' => 'auth'], function () {
    Route::get('form-field-error-msg', function () {
        return view('common.form-field-error-msg');
    });
});