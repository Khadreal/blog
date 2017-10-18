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

/*Route::get('/', function () {
    return view('welcome');
});
*/


// Get Routes
Route::get('/',[
	'uses'		=>		'PagesController@index'
]);
Route::get('/category/{slug}', [
	'uses'		=>		'PagesController@getCategoryPost'
]);
Route::get('/{slug}', [
	'uses'		=>		'PagesController@singlePost'
]);
//Post Routes
Route::post('/create', [
	'uses'			=>		'PostController@savePost'
]);
Route::post('add-category', [
	'uses'			=>		'PostController@addCategory'
]);

//Group Route
Route::group(['middleware' => ['auth']], function()
{
	Route::get('create', [
		'uses'		=>		'PagesController@createPost'
	]);

	Route::get('add-category', [
		'uses'		=>		'PagesController@addCategory'
	]);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


