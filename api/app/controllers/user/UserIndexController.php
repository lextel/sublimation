<?php

//namespace Controllers\Center;
//use BaseController;
class UserIndexController extends BaseController {
    
    protected function getUnreadCount($memberId){
        $count = Sms::where('member_id', '=', $memberId)->count();
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
	               'unreadcount' => Sms::where('owner_id', '=', $user->id)->where('status', '=', '0')->count()];
	       
	       return Response::json($res);
	       
	    } 
		return "来测试下";
	}

}
