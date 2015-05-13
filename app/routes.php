<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::api('v1', function()
{
    Route::get('/', 'AuthController@index');
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::get('/logout', 'AuthController@logout');

    Route::get('/swaps', 'SwapController@index');
    Route::get('/swaps/{id}', 'SwapController@show');

    Route::post('/swaps/offer/create/image/{swapId}', 'OfferController@storeImage');
    Route::post('/swaps/offer/create/{swapId}', 'OfferController@store');
    Route::post('/swaps/offer/accept/{offerId}', 'OfferController@accept');
    Route::post('/swaps/offer/accept/remove/{swapId}', 'OfferController@removeAccept');

    Route::get('/messages', 'MessageController@index');
    Route::get('/conversations', 'ConversationController@index');
});