<?php
/*
*用户地址列表
*/

class UserAddressController extends \BaseController {
    //检测数据库是否存在 未删除的数据
    private function check($addressId)
    {
        $user = Auth::getUser();
        $address = Address::where('id', '=', $addressId)
	                   ->where('member_id', '', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->first();
	    return $address;
    }
    
    //获得地址列表页
    public function index($pn=0)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    $count = Address::where('member_id', '', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->count();
	    $addresses = [];
	    if ($count > $pn){
	        $addresses = Address::select('id', 'name', 'mobile', 'rate', 'address')
	                   ->where('id', '=', $addressId)
	                   ->where('member_id', '', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->orderBy('id', 'desc')
	                   ->get()->toArray();
	    }
	    $data = ['addresses' => $addresses,
	             'count' => $count];
	    $res = ['code'=>0, 'msg'=>'OK', 'data'=>$data];
	    return Response::json($res);
    }
    
    //获得单个地址
    public function get($adressId)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    //检测是否存在地址
	    $address = $this->check($addressId);
	    if (!$address){
           $res = ['code'=>1, 'msg'=>'该地址不存在'];
           return Response::json($res);
        }
        $res = ['code'=>0, 'msg'=>'OK', 'data'=>$address];
        return Response::json($res);
    
    }
    
    //快速设置默认地址
    public function setDefault($addressId)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    //检测是否存在地址
	    $address = $this->check($addressId);
	    if (!$address){
           $res = ['code'=>1, 'msg'=>'该地址不存在'];
           return Response::json($res);
        }
        $default = Address::where('rate', '=', 100)
	                   ->where('member_id', '', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->first();
	    if ($default){
	        $default->rate = 0;
	        $default->save();
	    }
	    
        $address->rate = 100;
        if (!$address->save()){
           $res = ['code'=>1, 'msg'=>'数据库错误'];
           return Response::json($res);
        }
        $res = ['code'=>0, 'msg'=>'修改成功'];
        return Response::json($res);
        
    }
    
    //添加地址
    public function create()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    //检测输入
	    
	    //保存
	    
	    //当rate = 100, 设置默认
	    if ($rate == 100){
            $default = Address::where('rate', '=', 100)
	                   ->where('member_id', '', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->first();
	        if ($default){
	            $default->rate = 0;
	            $default->save();
	        }
	    }
	    $res = ['code'=>0, 'msg'=>'修改成功'];
        return Response::json($res);
    }
    
    //修改地址
    public function update($addressId)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    //检测是否存在地址
	    $address = $this->check($addressId);
	    if (!$address){
           $res = ['code'=>1, 'msg'=>'该地址不存在'];
           return Response::json($res);
        }
        //检测输入
        
        //保存
        
        //当rate = 100,设置默认
        if ($rate == 100){
            $default = Address::where('rate', '=', 100)
	                   ->where('member_id', '', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->first();
	        if ($default){
	            $default->rate = 0;
	            $default->save();
	        }
	    }
        $res = ['code'=>0, 'msg'=>'修改成功'];
        return Response::json($res);
        
    }
    
    //删除地址
    public function delete($addressId)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    //检测是否存在地址
	    $address = $this->check($addressId);
	    if (!$address){
           $res = ['code'=>1, 'msg'=>'该地址不存在'];
           return Response::json($res);
        }
        $address->is_delete = 1;
        if (!$address->save()){
            $res = ['code'=>1, 'msg'=>'数据库错误'];
            return Response::json($res);
        }
        $res = ['code'=>0, 'msg'=>'删除成功'];
        return Response::json($res);
    }
}
