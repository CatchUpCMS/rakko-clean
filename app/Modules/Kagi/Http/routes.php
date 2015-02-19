<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
/*
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
*/

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
/*
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
*/
/*
Route::get('auth/login', array('before' => 'throttle:2,2', function () {
    return 'Why herro there!';
}, ));
*/

Route::get('kagi', 'KagiController@index');
/*
Route::group(['prefix' => 'kagi'], function() {
//	Route::get('home', 'KagiController@index');
});
*/

// Login a user with GitHub (or any provider).
Route::get('social/login', 'SocialAuthController@login');

Route::controllers([
	'auth' => 'kagiAuthController',
	'password' => 'KagiPasswordController',
]);
Route::group(['prefix' => 'auth'], function() {
	Route::get('confirm/{code}', 'kagiAuthController@getConfirm');
//	Route::post('confirm/{code}', 'kagiAuthController@postConfirm');
	Route::post('confirm/{code}', 'kagiAuthController@postConfirm');
});

//Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
Route::group(['prefix' => 'admin'], function() {
	Route::pattern('id', '[0-9]+');
//	Route::pattern('id2', '[0-9]+');

	#Users
/*
	Route::resource('users', 'UsersController',
		[
//			'before' => 'csrf'
//			'except' => array('show')
		]);
*/
# Users
	Route::resource('users', 'UsersController');
# Roles
	Route::resource('roles', 'RolesController');
# Permissions
	Route::resource('permissions', 'PermissionsController');


// API DATA
	Route::get('api/users', array(
	//	'as'=>'api.users',
		'uses'=>'UsersController@data'
		));
	Route::get('api/roles', array(
	//	'as'=>'api.users',
		'uses'=>'RolesController@data'
		));
	Route::get('api/permissions', array(
	//	'as'=>'api.users',
		'uses'=>'PermissionsController@data'
//		'uses'=>'PermissionsController@getDatatable'
		));


});


/*
|--------------------------------------------------------------------------
| Chumper Datatables API
|--------------------------------------------------------------------------
*/
