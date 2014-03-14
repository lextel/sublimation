<?php
/*
*用户明细的列表
*
*/

class UserLogController extends BaseController {
    private $page_size = 10;
        
    //打开明细页面
    public function userlog()
    {
        if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	    }
	    $user = Auth::getUser();
	    return View::make('home/userlog');
    }
    
    //消费列表
    public function buylog($pn=0)
    {
       if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	   }
       $user = Auth::getUser();
       $userId = $user->id;
       $count = Moneylog::countOfType(1, $userId);
       $logs = [];
       if ($count > $pn){
           $logs = Moneylog::logsOfType(1, $userId, $this->page_size, $pn)
                   ->select('id', 'sum', 'created_at')
                   ->get()
                   ->toArray();  
       }
       foreach($logs as &$row){
	         $row['created_at'] = date("Y-m-d H:i:s", $row['created_at']);
	   }                           
       $data = ['logs'=>$logs,
                'buy_sum'=>Moneylog::sumOfType(1, $userId),
                'money_sum'=>Moneylog::sumOfType(0, $userId),
                'count'=>$count
                ];
       $res = ['code'=>0, 'msg'=>'OK', 'data'=>$data];
       return Response::json($res);
    }
    
    //充值列表
    public function moneylog($pn=0)
    {
       if (! Auth::check()){
	        $res = ['code'=>1, 'msg'=>'请登陆'];
            return Response::json($res);
	   }
       $user = Auth::getUser();
       $userId = $user->id;
       $count = Moneylog::countOfType(0, $userId);     
       $logs = [];
       if ($count > $pn){
           $logs = Moneylog::logsOfType(0, $userId, $this->page_size, $pn)
                 ->select('id', 'sum', 'created_at', 'source')
                 ->get()
                 ->toArray();
       }
       foreach($logs as &$row){
	         $row['created_at'] = date("Y-m-d H:i:s", $row['created_at']);
	   }                         
       $data = ['logs'=>$logs,
                'buy_sum'=>Moneylog::sumOfType(1, $userId),
                'money_sum'=>Moneylog::sumOfType(0, $userId),
                'count'=>$count
                ];
       $res = ['code'=>0, 'msg'=>'OK', 'data'=>$data];
       return Response::json($res);
    }

}
