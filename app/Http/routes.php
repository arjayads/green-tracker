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
    Route::get('topSeller', ['uses' => 'ProfileController@findTopSeller']);
    Route::get('incentive', ['uses' => 'ProfileController@totalIncentive']);
});

// Authentication routes...
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'rolefilter:admin']], function () {
    Route::get('/', ['uses' => 'Admin\MainController@index']);

    // data and actions
    Route::group(['prefix' => 'emp', 'middleware' => ['auth', 'rolefilter:admin']], function () {
        Route::get('', ['uses' => 'Admin\EmployeeController@index']);
        Route::get('create', ['uses' => 'Admin\EmployeeController@create']);
        Route::get('countFind', ['uses' => 'Admin\EmployeeController@countFind']);
        Route::get('{id}/detail', ['uses' => 'Admin\EmployeeController@detail']);
        Route::get('{id}/edit', ['uses' => 'Admin\EmployeeController@edit']);
        Route::get('{id}/getForEdit', ['as' => 'emp-get', 'uses' => 'Admin\EmployeeController@getForEdit']);
        Route::get('list', ['as' => 'emp-list', 'uses' => 'Admin\EmployeeController@empList']);
        Route::post('create', ['as' => 'store-emp', 'uses' => 'Admin\EmployeeController@store']);
        Route::get('find', ['uses' => 'Admin\EmployeeController@find']);
    });
    Route::group(['prefix' => 'leave', 'middleware' => ['auth', 'rolefilter:admin']], function () {
        Route::get('/', 'Admin\LeaveController@index');
        Route::get('/{id}', 'Admin\LeaveController@show');
        Route::get('/{status?}/list', 'Admin\LeaveController@listByStatus');

        Route::post('/process', 'Admin\LeaveController@process');
    });
});

Route::group(['prefix' => 'sales', 'middleware' => 'auth'], function () {
    Route::get('/', ['uses' => 'Sales\SalesController@index']);
    Route::get('create', ['uses' => 'Sales\SalesController@create']);

    Route::post('create', ['uses' => 'Sales\SalesController@store']);
    Route::post('process', ['uses' => 'Sales\SalesController@process']);
    Route::post('{id}/setVerified', ['uses' => 'Sales\SalesController@setVerified']);

    Route::get('countFind', ['uses' => 'Sales\SalesController@countFind']);
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
    Route::post('post', ['uses' => 'PostController@love']);
});

Route::group(['prefix' => 'my', 'middleware' => 'auth'], function () {
    Route::get('leave', 'LeaveController@index');
    Route::get('leave/{id}', 'LeaveController@show');
    Route::get('leaves/{status?}', 'LeaveController@myList');
    Route::get('leaveApplication', 'LeaveController@apply');

    Route::post('leaveApplication', 'LeaveController@create');
    Route::post('leave/{id}/cancel', 'LeaveController@cancel');
});
// directives
Route::group(['prefix' => 'common', 'middleware' => 'auth'], function () {
    Route::get('form-field-error-msg', function () {
        return view('common.form-field-error-msg');
    });
    Route::get('leaveTypes', 'LeaveController@types');
});