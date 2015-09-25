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

Route::get('/profile', ['middleware' => 'auth', 'as' => 'profile', function () {
    return view('profile');
}]);

// Authentication routes...
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

// data and actions
Route::group(['prefix' => 'emp'], function () {
    Route::get('/', function () {
        return view('emp.list');
    });
    Route::get('create', function () {
        return view('emp.create');
    });

    Route::get('countFind', ['uses' => 'EmployeeController@countFind']);
    Route::get('{id}/detail', ['uses' => 'EmployeeController@detail']);
    Route::get('{id}/edit', ['uses' => 'EmployeeController@edit']);
    Route::get('{id}/getForEdit', ['as' => 'emp-get', 'uses' => 'EmployeeController@getForEdit']);
    Route::get('list', ['as' => 'emp-list', 'uses' => 'EmployeeController@empList']);
    Route::post('create', ['as' => 'store-emp', 'uses' => 'EmployeeController@store']);
});

Route::group(['prefix' => 'sales'], function () {
    Route::get('/', function () {
        return view('sale.list');
    });

    Route::get('create', function () {
        return view('sale.create', ['patientId' => null]);
    });

    Route::post('create', ['uses' => 'Sales\SalesController@store']);
    Route::post('process', ['uses' => 'Sales\SalesController@process']);
    Route::get('list', ['as' => 'sales-list', 'uses' => 'Sales\SalesController@salesList']);
    Route::get('{id}/detail', ['uses' => 'Sales\SalesController@detail']);
    Route::get('statuses', ['uses' => 'Sales\SalesController@statuses']);
});

Route::group(['prefix' => 'campaign'], function () {
    Route::get('list', ['uses' => 'CampaignController@campaignList']);
    Route::get('{campaignId}/products', ['uses' => 'CampaignController@products']);
});


Route::group(['prefix' => 'shift'], function () {
    Route::get('list', ['uses' => 'ShiftController@shiftList']);
});

Route::group(['prefix' => 'group'], function () {
    Route::get('list', ['uses' => 'GroupController@groupList']);
});

Route::group(['prefix' => 'post'], function () {
    Route::get('list', ['uses' => 'PostController@posts']);
    Route::get('{id}', ['uses' => 'PostController@find']);
    Route::post('create', ['uses' => 'PostController@store']);
});

// directives
Route::group(['prefix' => 'common'], function () {
    Route::get('form-field-error-msg', function () {
        return view('common.form-field-error-msg');
    });
});