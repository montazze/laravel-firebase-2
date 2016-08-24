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

const PREFIX_WEB = "";

Route::group(array('prefix' => PREFIX_WEB), function() {

    Route::get('/','FrontEnd\HomeController@index');
});