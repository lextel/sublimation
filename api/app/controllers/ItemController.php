<?php

class ItemController extends AppController {

    public function getIndex() {

        $sort = Input::get('sort', 'win');
        $orderBy  = Input::get('orderBy', 'asc');
        $cateId = Input::get('cateId', 0);
        $page  = Input::get('page', 1);

        $title = "所有商品";

        $url = url('m/list');
        $itemClass = new ItemClass();
        $sortList = $itemClass->createSort($url, $sort, $orderBy);

        $header = View::make('api.main_header')->with('title', $title)->render(); 
        $main   = View::make('api.item.index')->with('sortList', $sortList)
                                              ->with('page', $page)
                                              ->render();
        $footer = View::make('api.index_footer')->render();

        return Response::json(['code'=>0 ,'msg' => '', 'data' => ['header' => $header, 'main' => $main, 'footer' => $footer]])
                         ->header('Access-Control-Allow-Origin', '*');
    }

    public function getList() {

        $sort = Input::get('sort', 'win');
        $orderBy  = Input::get('orderBy', 'asc');
        $cateId = Input::get('cateId', 0);
        $page  = Input::get('page', 1);

        $url = url('m/list');
        $itemClass = new ItemClass();
        $sortList = $itemClass->createSort($url, $sort, $orderBy);
        
        $itemModel = new Item();
        $field = ItemClass::$dbAlias[$sort];
        $lists = $itemModel->lists($field, $orderBy, $cateId, $page);

        $list = View::make('api.item.list')
                      ->with('page', $page)
                      ->with('lists', $lists)
                      ->render();

        return Response::json(['code'=>0, 'msg'=>'', 'data' => ['list' => $list]])
                         ->header('Access-Control-Allow-Origin', '*');;
    }

}
