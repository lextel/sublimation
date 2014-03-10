<?php

//namespace Controllers\Center;
//use BaseController;
class UserIndexController extends BaseController {
    
    private function getUnreadCount($memberId){
        $count = Sms::where('owner_id', '=', $user->id)->where('status', '=', '0')->count();
        return $count;
    }
    
	/**
	 *用户中心首页
	 * 输出 用户昵称，头像，用户邮箱，用户积分，用户未读消息总数
	 */
	public function index()
	{
	    if (Auth::check()){
	       $user = Auth::getUser();
	       $res = ['nickname' => $user->nickname,
	               'avatar' => $user->avatar,
	               'email' => $user->email,
	               'points' => $user->points,
	               'unreadcount' => getUnreadCount($user->id)];
	       
	       return Response::json($res);
	       
	    } 
		$res = ['code'=>1, 'msg'=>'请登陆'];
        return Response::json($res);
	}
	
	/*
	*用户修改头像
	*
	*/
	public function avatar()
	{
	    if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $avatar = Input::get('avatar');
	    $validator = Validator::make(
        [
            'avatar' => $avatar
        ],[
            'avatar' => 'required',
        ]);
        if ($validator->fails()){
            $res = ['code'=>1, 'msg'=>'图片未输入'];
            return Response::json($res);
        }
	    $user = Auth::getUser();
	    $user->avatar = $avatar;
	    $user->save();
	    $res = ['code'=>0, 'msg'=>'修改头像成功'];
        return Response::json($res); 
	}

}
