<?php


/*
|--------------------------------------------------------------------------
| Module: Installer
|--------------------------------------------------------------------------
*/


Route::get('welcome/installer', array(
	'uses'=>'InstallerController@welcome'
	));


Route::group(
	[
	'prefix'=>'install',
	'before'=>'install'
	],
	function()
	{
		if ( Config::get('rakko.install') ) {
			Flash::warning(trans('installer::install.error.installed'));
			return redirect('/');
		}

		Route::get('/','InstallerController@getIndex');
		Route::get('/artisan','InstallerController@getArtisan');
		Route::get('/settings','InstallerController@getSettings');
		Route::post('/settings','InstallerController@postSettings');
		Route::get('/final','InstallerController@getFinal');

	});
