<?php

class Cate extends Eloquent {

    protected $table = 'cates';


    /**
     * 获取指定排序的分类
     *
     * @param $limit string 数量
     * @param $sort  string 排序方式  id desc
     *
     * return obj
     */
    public function getBySort($limit, $sortField = 'id', $sortOrder = 'desc') {
        return Cate::where('is_delete', '!=', 1)
                      ->take($limit)
                      ->orderBy($sortField, $sortOrder)
                      ->get();
    }

}
