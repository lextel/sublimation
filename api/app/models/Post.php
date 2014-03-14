<?php
/*
*晒单数据表
*/

class Post extends Eloquent  {

    protected $table = "posts";
    //查询是否存在未删除的晒单
    public function scopeGetPost($query, $userId, $postId){
        return $query->where('member_id', '=', $userId)
                      ->where('id', '=', $postId)
                      ->where('is_delete', '=', 0)
                      ->count();
    }
   
}
