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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {

    Route::get('/', 'WelcomeController@show');
    Route::get('/home', 'HomeController@show');

    Route::resource('contacts', 'UserContactController');

    Route::resource('deals', 'UserDealController');

    Route::resource('invoices', 'UserInvoiceController');
    Route::resource('quotes', 'UserQuoteController');
    Route::resource('recurring', 'UserRecInvoiceController');
    Route::resource('config', 'UserConfigController');
    Route::resource('payments', 'UserPaymentController');
    Route::resource('config', 'UserConfigController');

    Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

});

///
///
///