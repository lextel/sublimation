<?php

class ItremClass {

    public static $pagesize = 10;

    /**
     * 排序的配置
     */
    public static $sort = [
            ['alias' => 'win', 'name' => '最新揭晓', 'field' => 'remain', 'sort' => 'asc'],
            ['alias' => 'hot', 'name' => '人气', 'field' => 'hots', 'sort' => 'desc'],
            ['alias' => 'price', 'name' => '价格',  'field' => 'cost', 'sort' => ['asc', 'desc']],
            ['alias' => 'new', 'name' => '最新', 'field' => 'item_created_at', 'sort' => 'desc'],
        ];


    /**
     * 获取排序字段
     */
    public static function sortField($alias) {
        foreach(self::$sort as $item) {

            if($item['alias'] == $alias) return $item['field'];
        }

        return self::$sort[0]['field'];
    }
}
