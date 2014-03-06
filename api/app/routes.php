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

//打开登录页面
Route::get('/signin', function()
{
    //检测是否已经登录
    if (Auth::check()){
       return Redirect::to('/');
    }
	return View::make('signin');
});

//打开注册页面
Route::get('/signup', function()
{
	//检测是否已经登录
	if (Auth::check()){
       return Redirect::to('/');
    }
	return View::make('signup');
});

//退出登录
Route::get('/signout', function()
{
    Auth::logout();
	return Redirect::to('/');
});

Route::post('/signin', function()
{
    $username = trim(Input::get('username'));
    $password = trim(Input::get('password'));	
    //验证输入是否符合格式
    $validator = Validator::make(
    [ 
        'username' => $username,
        'password' => $password,
    ],[
        'username' => 'required|email',
        'password' => 'required|min:6|max:20',
    ]);
    if ($validator->fails()){
        $res = ['code'=>1, 'msg'=>'输入账号/密码格式不符合'];
        return Response::json($res);
    }
    //验证是否在数据库
    $user = User::where('username', '=', $username)->first();
    if (! $user){
        $res = ['code'=>1, 'msg'=>'账户不存在'];
        return Response::json($res);
    }
    //验证密码是否正确,改动check   
    /*if(Auth::attempt($value)){
        $res = ['code'=>0, 'msg'=>'登录成功'];
        return Response::json($res);
    }*/
    if (Hash::make($password, ['method'=>'pbkdf2']) == $user->password){
        Auth::login($user);
        $res = ['code'=>0, 'msg'=>'登录成功'];
        return Response::json($res);
    }
	$res = ['code'=>1, 'msg'=>'用户密码错误'];
	return Response::json($res);
});



Route::post('/signup', function()
{
    $username = trim(Input::get('username'));
    $password = trim(Input::get('password'));
    $nickname = trim(Input::get('nickname'));
    $value = ['username'=>$username,
              'password'=>$password,
              'nickname'=>$nickname];
    //验证是否符合格式
    $validator = Validator::make(
    [ 
        'username' => $username,
        'password' => $password,
        'nickname' => $nickname,
    ],[
        'username' => 'required|email',
        'password' => 'required|min:6|max:20',
        'nickname' => 'required|min:2|max:8',
    ]);
    if ($validator->fails()){
        $res = ['code'=>1, 'msg'=>'输入不符合格式'];
        return Response::json($res);
    }
    //验证是否存在username
    if (Member::where('username', '=', $username)->first()){
        $res = ['code'=>1, 'msg'=>'您注册的账户已经存在'];
        return Response::json($res);
    }
    //验证是否有昵称
    if (Member::where('nickname', '=', $nickname)->first()){
        $res = ['code'=>1, 'msg'=>'您注册的昵称已经存在'];
        return Response::json($res);
    }
    
    Member::create(array(
      'username' => $username,
      'password' => Hash::make($password, ['method'=>'pbkdf2']),   // 生成密码.
      'email' => $username,
      'nickname' => $nickname,
    ));
    
    $user = User::where('username', '=', $username)->first();
    
    if (! $user){
        $res = ['code'=>1, 'msg'=>'用户不存在'];
        return Response::json($res);
    }
    Auth::login($user);
    $res = ['code'=>0, 'msg'=>'注册成功'];
    return Response::json($res);
});


//临时代码
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

