<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	//return View::make('hello');
	$crypt = new \Crypt_Base();
    $crypt->setPassword(1234567);
	return base64_encode($crypt->key);
});

Route::get('/signin', function()
{
	return View::make('signin');
});

Route::post('/signin', function()
{
	return Redirect::to('/');
});

Route::get('/signup', function()
{
	return View::make('signup');
});

Route::post('/signup', function()
{
	return Redirect::to('/');
});

Route::get('/signout', function()
{
    Auth::logout();
	return Redirect::to('/');
});

Route::get('/users', function()
{
    $users = Member::all();
	return Response::json([
        'code' => 0,
        'users' => $users->toArray(),
        'msg' => '',
        200]
    );
});

