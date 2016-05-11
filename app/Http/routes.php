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
    return redirect("/albums");
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/album/add', 'AlbumController@postAddAlbum');
    Route::post('/album/edit', 'AlbumController@postEditAlbum');

	Route::get('/albums', 'AlbumController@getAlbums');
	Route::get('/albums/{id?}', 'AlbumController@getAlbum');
    Route::get('/albums/confirm-delete/{id}', 'AlbumController@getConfirmDelete');
    Route::get('/albums/delete/{id}', 'AlbumController@getDoDelete');
    Route::get('/albums/edit/{id}', "AlbumController@getEditAlbum");

	Route::get('/artists', 'ArtistController@index');
	Route::get("/artists/{id?}", 'ArtistController@show');

	Route::get('/album/add', function () {
	    return view('layout.master', ["type" => "album"])->nest("content", "album.add", ["type" => "album"]);
	});
});


# Show login form
Route::get('/login', 'Auth\AuthController@getLogin');

# Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

# Process logout
Route::get('/logout', 'Auth\AuthController@logout');

# Show registration form
Route::get('/register', 'Auth\AuthController@getRegister');

# Process registration form
Route::post('/register', 'Auth\AuthController@postRegister');

Route::auth();

Route::get('/home', 'HomeController@index');
