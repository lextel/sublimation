<?php
/*
*用户明细表MODEL
*/

class Moneylog extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'member_moneylogs';
	
	//protected $fillable = [];
	
    //public $timestamps = true;
    
    /*
    *统计总额
    * type = 0 为充值， 1为消费
    */
    public function scopeSumOfType($query, $type, $memberId)
    {
        return $query->where('member_id', '=', $memberId)
                 ->where('type', '=', $type)
                 ->sum('sum');
    }
    /*
    *查询用户详情列表
    * type = 0为充值，1为消费
    */
    public function scopeLogsOfType($query, $type, $memberId, $page_size=10, $pn=0)
    {
        return $query->where('member_id', '=', $memberId)
                 ->where('type', '=', $type)
                 ->orderBy('id', 'desc')
                 ->take($page_size)
                 ->skip($pn);
    }
    
    /*
    *统计该用户同一类的总数
    */
    public function scopeCountOfType($query, $type, $memberId)
    { 
       return $query->where('member_id', '=', $memberId)
                 ->where('type', '=', $type)
                 ->count();
    }
}
