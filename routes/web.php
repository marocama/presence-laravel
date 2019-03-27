<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/presence', 'PresenceController@index')->name('presence');
    Route::get('/setPresence', 'setPresenceController@index')->name('setPresence');
    Route::post('/setPresence', 'setPresenceController@confirm')->name('setPresence.confirm');

    Route::get('/setCheckout', 'setCheckoutController@index')->name('setCheckout');
    Route::post('/setCheckout', 'setCheckoutController@confirm')->name('setCheckout.confirm');

    Route::get('/events', 'EventsController@index')->name('events');
    Route::post('/events', 'EventsController@add')->name('events.add');
    Route::get('/showEvents', 'EventsController@data')->name('showEvents');

    Route::get('/setPass', 'setPassController@index')->name('setPass');
    Route::post('/setPass', 'setPassController@alterPass')->name('setPass.alterPass');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
