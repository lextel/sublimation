<?php
/*
*用户获得商品的列表
*
*/

class UserWinController extends BaseController {
    private $page_size = 10;
    //打开用户获得的商品页面
    public function userwin()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $title = '获得的商品';
	    return View::make('userwins');
    }
    //用户获得的商品数据接口
    public function userwinlist($pn=0)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    $userId = $user->id;
	    $count = Phase::where('member_id', '=', $userId)->count();
	    $wins = [];
	    if ($count > $pn){
	        $wins = Phase::select('id', 'image', 'title', 'phase_id', 'amount', 'code', 'opentime')
	            ->where('member_id', '=',$userId)
	            ->orderBy('id', 'desc')
	            ->take($this->page_size)
	            ->skip($pn)
	            ->get()->toArray();
	    }
	    $data = ['wins'=>$wins, 'count'=>$count];
	    $res = ['code'=>0,'msg'=>'OK', 'data'=>$data];
	    return Response::json($res);         
	            
    }
    
    //用户物流信息
    public function shippingInfo($phaseId){
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    //期数信息
	    $phase = Phase::select('id', 'image', 'title', 'phase_id', 'amount', 'code', 'opentime', 'member_id')
	         ->where('id', '=', $phaseId)
	         ->where('code', '!=', '')
	         ->first()->toArray();
	    //快递信息
	    $shipping = Shipping::select('excode', 'exname', 'exdesc')
	         ->where('phase_id', '=', $phaseId)
	         ->first()->toArray();
	    $username = Auth::getUser()->nickname;
	    $res = ['phase'=>$phase, 'shipping'=>$shipping, 'username'=>$username];
	    return Response::json($res);
    }
    

}
