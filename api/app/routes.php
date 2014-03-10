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
        return View::make('hello');
    });

Route::group(['prefix' => 'api/'], function() {
    Route::get('/', function()
    {
        return View::make('hello');
    });

    Route::get('index', function()
    {
        return View::make('hello');
    });
    //用户注册\登录功能
    Route::get('signin', 'UserController@getSignIn');
    Route::post('signin', 'UserController@signIn');
    Route::get('signup', 'UserController@getSignUp');
    Route::post('signup', 'UserController@signUp');
    Route::get('signout', 'UserController@signOut');
    
    
});

Route::group(['prefix' => 'api/u/'], function() {
    //我的中心
    Route::get('/', ['as'=>'index', 'uses'=>'UserIndexController@index']);
    //头像修改
    Route::post('avatar', ['as'=>'avatar', 'uses'=>'UserIndexController@avatar']);
});

//临时代码
Route::get('api/users', function()
{
    $users = Member::all();
    return Response::json([
        'code' => 0,
        'users' => $users->toArray(),
        'msg' => '',
        200]
    );
});

