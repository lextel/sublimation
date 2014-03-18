<?php

class ItemController extends AppController {

    // 首页模板
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

    // 商品列表内容
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

    // 商品详情
    public function getView() {

        $id = Input::get('id');
        if(empty($id)) return Response::json(['code' => 1, 'msg' => '参数错误']);

        $itemModel = new Item();
        $item = $itemModel->view($id);

        return Response::json(['code'=>0, 'msg'=>'', 'data' => ['list' => $item]])
                         ->header('Access-Control-Allow-Origin', '*');;

    }

    // 所有乐拍记录
    public function getOrder() {

        $id = Input::get('id');
        $page = Input::get('page', 1);

        if(empty($id)) return Response::json(['code' => 1, 'msg' => '参数错误']);

        $itemModel = new Item();
        $order = $itemModel->order($id, $page);

        return Response::json(['code'=>0, 'msg'=>'', 'data' => ['list' => $order]])
                         ->header('Access-Control-Allow-Origin', '*');;

    }

    // 图文详情
    public function getInfo() {

        $id = Input::get('id');

        if(empty($id)) return Response::json(['code' => 1, 'msg' => '参数错误']);

        $itemModel = new Item();
        $info = $itemModel->info($id);

        return Response::json(['code'=>0, 'msg'=>'', 'data' => ['main' => $info]])
                         ->header('Access-Control-Allow-Origin', '*');;
    }

}
