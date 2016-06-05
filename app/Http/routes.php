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
// Authentication Routes...
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

// Registration Routes...
$this->get('register', 'Auth\AuthController@showRegistrationForm');
$this->post('register', 'Auth\AuthController@register');

// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController');
	Route::resource('message', 'MessageController');
	Route::get('/', 'PageController@showHome');
	Route::post('/search', 'TaskController@search');
	Route::get('/dashboard','PageController@showHome');
	Route::get('/download/{taskId}/{commentId}','FileController@getCommentAttachment');
	Route::get('/view/{taskId}/{commentId}','FileController@viewCommentAttachment');
	Route::get('/download/{taskId}','FileController@getTaskAttachment');
	Route::get('/message/view/{messageId}','FileController@viewMessageAttachment');
	Route::get('/view/{taskId}','FileController@viewTaskAttachment');
	Route::get('/lockscreen', function () {
		return view('lockscreen');
	});
	Route::resource('task', 'TaskController');
	Route::resource('task.comment', 'TaskCommentController');
});
Route::resource('office', 'OfficeController');

Route::get('/qlog','PageController@showQueryLog');



//Route::get('/home', 'HomeController@index');
