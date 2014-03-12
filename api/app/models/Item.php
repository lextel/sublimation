<?php

class Item extends Eloquent {

    protected $table = 'items';

    /**
     * 获取商品列表
     *
     * @param $alias string 排序字段
     * @param $sort  string 排序方式
     * @param $page  int    页码
     *
     * @return array
     */
    public function lists($alias, $sort, $page) {

        $pagesize = ItemClass::$pagesize;
        $skip = ($page-1) * $pagesize;
        
        $field = ItemClass::sortField($alias);


        return Phase::frontend()->orderBy($field, $sort)
                               ->skip($skip)
                               ->take($pagesize)
                               ->get()
                               ->toArray();
    }

}
