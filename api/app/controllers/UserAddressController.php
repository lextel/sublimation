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
	                   ->where('member_id', '=', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->first();
	    return $address;
    }
    
    
    //获得地址列表页
    public function index()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    $addresses = Address::select('id', 'name', 'mobile', 'rate', 'address')
	                   ->where('member_id', '=', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->orderBy('id', 'desc')
	                   ->get();
	    
	    foreach($addresses as &$row){
	        $row->address = implode(' ', unserialize($row->address));
	    }	    
	    return View::make('home/address', ['addresses'=>$addresses]);
    }
    //打开页面
    public function getPage()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
        return View::make('home/addressadd');
    }
    
    //获得单个地址
    public function get($addressId)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    //检测是否存在地址
	    $address = $this->check($addressId);
	    $address->address = unserialize($address->address);
	    if (!$address){
           $res = ['code'=>1, 'msg'=>'该地址不存在'];
           return Response::json($res);
        }
        //$res = ['code'=>0, 'msg'=>'OK', 'data'=>$address];
        return View::make('home/addressmodify', ['address' => $address]);  
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
	                   ->where('member_id', '=', $user->id)
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
	    $validator = Validator::make(Input::all(),
        [
            'name' => 'required',
            'mobile' => 'required',
            'province' => 'required',
            'city' => 'required',
            'county' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()){
            $res = ['code'=>1, 'msg'=>'输入格式不符合'];
            return Response::json($res);
        }
	    //保存
	    $address = new Address;
	    $address->name = trim(Input::get('name'));
        $address->mobile = trim(Input::get('mobile'));
        $address->postcode = trim(Input::get('postcode'));
        $add1 = trim(Input::get('province'));
        $add2 = trim(Input::get('city'));
        $add3 = trim(Input::get('county'));
        $add4 = trim(Input::get('address'));
        $add0 = [$add1, $add2, $add3, $add4];
        $address->address = serialize($add0);
        $address->member_id = $user->id;
        $rate = trim(Input::get('rate'));
	    //当rate = 100, 设置默认
	    if ($rate == 100){
            $default = Address::where('rate', '=', 100)
	                   ->where('member_id', '=', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->first();
	        if ($default){
	            $default->rate = 0;
	            $default->save();
	        }
	    }
	    $address->rate = $rate;
	    $address->save();
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
        $validator = Validator::make(Input::all(),
        [
            'name' => 'required',
            'mobile' => 'required',
            'province' => 'required',
            'city' => 'required',
            'county' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()){
            $res = ['code'=>1, 'msg'=>'输入格式不符合'];
            return Response::json($res);
        }
        //保存
        $address->name = trim(Input::get('name'));
        $address->mobile = trim(Input::get('mobile'));
        $address->postcode = trim(Input::get('postcode'));
        $add1 = trim(Input::get('province'));
        $add2 = trim(Input::get('city'));
        $add3 = trim(Input::get('county'));
        $add4 = trim(Input::get('address'));
        $add0 = [$add1, $add2, $add3, $add4];
        $address->address = serialize($add0);
        $rate = trim(Input::get('rate'));
        //当rate = 100,设置默认
        if ($rate == 100){
            $default = Address::where('rate', '=', 100)
	                   ->where('member_id', '=', $user->id)
	                   ->where('is_delete', '=', 0)
	                   ->first();
	        if ($default){
	            $default->rate = 0;
	            $default->save();
	        }
	    }
	    $address->rate = $rate;
	    $address->save();
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
