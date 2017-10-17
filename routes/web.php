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
	'as'	=>		'PostController@index'
]);
Route::get('/home',[
	'uses' => 'PostController@index'
]);
Route::get('user/{id}',[
	'UserController@profile'
])->where('id', '[0-9]+');

Route::get('user/{id}/posts',[
	'as'	=>		'UserController@user_posts'
])->where('id', '[0-9]+');

Route::get('/{slug}',[
	'as' => 'post', 'uses' => 'PostController@show'
])->where('slug', '[A-Za-z0-9-_]+');


Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);

// AUTH Route Group
Route::group(['middleware' => ['auth']], function()
{
	Route::get('new-post', [
		'uses'		=>		'PostController@create'
	]);
 
 	Route::get('edit/{slug}', [
 		'uses'		=>		'PostController@edit'
 	]);
 
 	Route::get('delete/{id}','PostController@destroy');
 
 	Route::get('my-all-posts','UserController@user_posts_all');
 
 	Route::get('my-drafts','UserController@user_posts_draft');
 	Route::post('comment/add','CommentController@store');
 	Route::post('new-post','PostController@store');
 	Route::post('update','PostController@update');
 	Route::post('comment/delete/{id}','CommentController@distroy');
});

