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
    return view('layout.master')->nest("content", "layout.grid");
});

Route::post('/album/add', 'AlbumController@postAddAlbum');

Route::get('/album/add', function () {
    return view('layout.master')->nest("content", "album.add");
});

