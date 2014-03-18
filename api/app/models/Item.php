<?php

class Item extends Eloquent {

    protected $table = 'items';

    /**
     * 获取商品列表
     *
     * @param $field    string 排序字段
     * @param $orderBy  string 排序方式
     * @param $cateId   int    分类ID
     * @param $page     int    页码
     *
     * @return array
     */
    public function lists($field, $orderBy, $cateId, $page) {

        $pagesize = ItemClass::$pagesize;
        $skip = ($page-1) * $pagesize;
        
        $phase = Phase::frontend();

        if($cateId != 0) {
            $phase = $phase->where('cate_id', $cateId);
        }

        return $phase->orderBy($field, $orderBy)
                     ->skip($skip)
                     ->take($pagesize)
                     ->get()
                     ->toArray();
    }

    /**
     * 渲染购物车
     *
     * return array
     */
    public function cart() {
        $cartItems = Cart::content();

        $items = [];
        foreach($cartItems as $item) {
            $phase = Phase::find($item->id)->toArray();
            $phase['rowId'] = $item->rowid;
            $phase['qty'] = $item->qty;

            $items[] = $phase;
        }

        return $items;
    }

    /**
     * 检查购物车过期商品
     *
     */
    public function cartCheck() {

        $cartItems = Cart::content();
        $return = true;
        foreach($cartItems as $item) {
            $phase = Phase::find($item->id)->toArray();

            if($item->qty > $phase['remain']) {
                $return = false;
            }
        }

        return $return;
    }

}
