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

Route::get('/', function () {
    return view('profile');
});

// data and actions
Route::group(['prefix' => 'user'], function () {
    Route::post('create', ['as' => 'store-user', 'uses' => 'Auth\UserController@store']);
    Route::get('list', ['as' => 'user-list', 'uses' => 'Auth\UserController@userList']);
});

Route::group(['prefix' => 'sales'], function () {
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

// view providers

Route::get('/main', function () {
    return view('main');
});

Route::group(['prefix' => 'html'], function () {

    Route::group(['prefix' => 'sales'], function () {
        Route::get('list', function () {
            return view('sales.list');
        });

        Route::get('detail', function () {
            return view('sales.detail');
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('list', function () {
            return view('user.list');
        });
        Route::get('create', function () {
            return view('user.create2');
        });
        Route::get('profile', function () {
            return view('user.profile');
        });
    });
});

// directives
Route::group(['prefix' => 'common'], function () {
    Route::get('form-field-error-msg', function () {
        return view('common.form-field-error-msg');
    });
});