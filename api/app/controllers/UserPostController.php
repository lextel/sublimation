<?php
/*
*用户晒单的列表
*
*/

class UserPostController extends BaseController {
    private $page_size = 10;
    //晒单统计
    private function postCount($userId)
    {
        $count = Post::where('member_id', '=', $userId)
                    ->where('is_delete', '=', 0)
                    ->count();
        return $count;
    }
    //未晒单统计
    private function nopostCount($userId)
    {
       $count = Phase::where('member_id', '=', $userId)
                    ->where('post_id', '=', 0)
                    ->count();
       return $count;
    }
    //打开晒单列表页面
    public function getPostPage()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
        $userId = $user->id;
	    $title = "我的晒单";
	    $postcount = $this->postCount($userId);
	    $nopostcount = $this->nopostCount($userId);
	    return View::make('userposts');
    }
    
    
    //晒单列表
    public function posts($pn=0)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
        $userId = $user->id;
        $count = $this->postCount($userId);
        $posts = [];
        if ($count > $pn){
           $posts = Post::select('id', 'title', 'desc', 'created_at', 'images')
                   ->where('member_id', '=', $userId)
                   ->where('is_delete', '=', 0)
                   ->orderBy('id', 'desc')
                   ->get()
                   ->toArray();  
        }
        foreach($posts as &$row){
	         $row['created_at'] = date("Y-m-d H:i:s", $row['created_at']);
	         $row['images'] = unserialize($row['images']);
	    }                           
        $data = ['posts'=>$posts,
                'count'=>$count,
                ];
        $res = ['code'=>0, 'msg'=>'OK', 'data'=>$data];
        return Response::json($res);
    
    }
    
    //未晒单列表
    public function noposts($pn=0)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
        $userId = $user->id;
        $count = $this->nopostCount($userId);
        $noposts = [];
        if ($count > $pn){
            $noposts = Phase::select('title', 'image', 'phase_id', 'amount', 'code', 'opentime')
                     ->where('member_id', '=', $userId)
                     ->where('post_id', '=', 0)
                     ->orderBy('id', 'desc')
                     ->get()
                     ->toArray();
        }
        foreach($noposts as &$row){
	         $row['opentime'] = date("Y-m-d H:i:s", $row['opentime']);
	    }                           
        $data = ['noposts'=>$noposts,
                'count'=>$count
                ];
        $res = ['code'=>0, 'msg'=>'OK', 'data'=>$data];
        return Response::json($res);
    
    }    
    
    //添加晒单页面
    public function createPage()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    return View::make('addpost');
    }
    //添加晒单
    public function create()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
        $userId = $user->id;
        //检测输入
        $validator = Validator::make(
        [
            'title' => 'required|min:6|max:32',
            'desc' => 'required',
            'images' => 'required',
            'phase' => 'required',
        ]);
        if ($validator->fails()){
            $res = ['code'=>1, 'msg'=>'输入格式不符合'];
            return Response::json($res);
        }
        //保存晒单
        $post = Post::create([
             'title' => Input::get('title'),
             'desc' => Input::get('desc'),
             'images' => unserialize(Input::get('images')),
             'topimage' => Input::get('images')[0],
             'member_id' => $userId,
             'phase_id' => Input::get('phase'),
             'item_id' => '',
        ]);
        if (!$post->id){
            $res = ['code'=>1, 'msg'=>'数据库错误'];
            return Response::json($res);
        }
        $res = ['code'=>0, 'msg'=>'添加晒单成功'];
        return Response::json($res);
        
    }
    //获得单个晒单的详情
    public function get($postid)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
        $userId = $user->id;
        $post = Post::where('member_id', '=', $userId)
                      ->where('id', '=', $postid)
                      ->where('is_delete', '=', 0)
                      ->first();
        if (!$post){
           $res = ['code'=>1, 'msg'=>'该晒单不存在'];
           return Response::json($res);
        }
        $res = ['code'=>0, 'msg'=>'OK', 'data'=>$post];
        return Response::json($res);
    }
    
    //提交单个晒单的内容
    public function update($postid)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
        $userId = $user->id;
        $post = Post::where('member_id', '=', $userId)
                      ->where('id', '=', $postid)
                      ->where('is_delete', '=', 0)
                      ->first();
        if (!$post){
           $res = ['code'=>1, 'msg'=>'该晒单不存在'];
           return Response::json($res);
        }
        //检测输入
        $validator = Validator::make(
        [
            'title' => 'required|min:6|max:32',
            'desc' => 'required',
            'images' => 'required',
        ]);
        if ($validator->fails()){
            $res = ['code'=>1, 'msg'=>'输入格式不符合'];
            return Response::json($res);
        }
         
        //检测OK保存
        $post->title = Input::get('title');
        $post->desc = Input::get('desc');
        $post->images = unserialize(Input::get('images'));
        $post->topimage = Input::get('images')[0];
        $post->status = 0;
        if (!$post->save()){
            $res = ['code'=>1, 'msg'=>'数据库错误'];
            return Response::json($res);
        }
        $res = ['code'=>0, 'msg'=>'编辑晒单成功'];
        return Response::json($res);
        
    }
    /*
    *删除单个晒单--软删除is_delete = 1
    */
    public function delete($postid)
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
        $userId = $user->id;
        //判断是否存在晒单
        $post = Post::where('member_id', '=', $userId)
                      ->where('id', '=', $postid)
                      ->where('is_delete', '=', 0)
                      ->first();
        if (!$post){
           $res = ['code'=>1, 'msg'=>'该晒单不存在'];
           return Response::json($res);
        }
        $post->is_delete = 1;
        if (!$post->save()){
            $res = ['code'=>1, 'msg'=>'数据库错误'];
            return Response::json($res);
        }
        $res = ['code'=>0, 'msg'=>'删除晒单成功'];
        return Response::json($res);
    }
    
        
}
