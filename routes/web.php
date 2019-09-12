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
    Route::get ('/', 'HomeController@index')->name('home');
    Route::get ('/home', 'HomeController@index')->name('home');
    Route::get ('/profile', 'HomeController@profile')->name('profile');
    Route::post('/profile', 'HomeController@alterPass')->name('profile.alterPass');

    Route::get ('/presence', 'PresenceController@index')->name('presence');
    Route::post('/presence', 'PresenceController@list')->name('presence.list');

    Route::post('/presence/register', 'PresenceController@write')->name('presence.register');
    
    Route::get ('/view/{id}', 'CityController@index')->name('city');

    Route::post('/view/upload/1', 'CityController@fileUploadInicio')->name('upload.inicio');
    Route::post('/view/upload/2', 'CityController@fileUploadFormalizacao')->name('upload.formaliza');
    Route::post('/view/upload/3', 'CityController@fileUpload1Apresentacao')->name('upload.1apresentacao');
    Route::post('/view/upload/4', 'CityController@fileUploadProduto1')->name('upload.produto1');

    Route::get ('/records', 'AdminController@index')->name('records');
    Route::get ('/alerts', 'AdminController@alerts')->name('alerts');
    Route::post('/alerts', 'AdminController@alertsReg')->name('alerts.reg');
    Route::get ('/new', 'AdminController@new')->name('new');
    Route::post('/new', 'AdminController@register')->name('new.conf');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get ('/', 'PublicController@index')->name('inicio');
