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
Route::pattern('pn', '[0-9]+');
Route::pattern('postid', '[0-9]+');
Route::pattern('phaseId', '[0-9]+');

Route::get('/', function()
    {
        return View::make('hello');
    });

Route::group(['prefix' => '/'], function() {
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

    // 商品列表
    Route::controller('m', 'ItemController');
});

Route::group(['prefix' => 'u/'], function() {
    //我的中心
    Route::get('/', ['as'=>'index', 'uses'=>'UserIndexController@index']);
    //头像修改
    Route::post('avatar', ['as'=>'avatar', 'uses'=>'UserIndexController@avatar']);
    //用户明细
    Route::get('log', ['as'=>'log', 'uses'=>'UserLogController@userlog']);
    Route::get('buylog/{pn?}', ['as'=>'buylog', 'uses'=>'UserLogController@buylog']);
    Route::get('moneylog/{pn?}', ['as'=>'moneylog', 'uses'=>'UserLogController@moneylog']);
    //用户获得的商品
    Route::get('userwin', 'UserWinController@userwin');
    Route::get('userwinlist/{pn?}', 'UserWinController@userwinlist');
    Route::get('usershipping/{phaseId?}', 'UserWinController@shippingInfo');
    //用户订单列表
    
    //用户晒单列表
    Route::get('postlist/', 'UserPostController@getPostPage');
    Route::get('posts/{pn?}', 'UserPostController@posts');
    Route::get('noposts/{pn?}', 'UserPostController@noposts');
    //Route::get('');
    Route::get('delpost/{postid}', 'UserPostController@delete');
    //用户地址列表
    Route::get('address', 'UserAddressController@index');
    Route::get('setaddress', 'UserAddressController@setDefault');
    Route::get('address/create', 'UserAddressController@getPage');
    Route::post('address/create', 'UserAddressController@create');
    Route::get('address/{id}/edit', '');
    Route::post('address/{id}/edit', '');
    Route::get('address/{id}/del', '');
    //
});

Event::listen('illuminate.query', function($sql)
{
   Log::info($sql);
}); 
