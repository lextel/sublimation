<?php

class ItemController extends AppController {

    public function getIndex() {

        $title = "所有商品";

        $header = View::make('api.main_header')->with('title', $title)->render(); 
        $main   = View::make('api.item.index')->render();
        $footer = View::make('api.index_footer')->render();

        return Response::json(['code'=>0 ,'msg' => '', 'data' => ['header' => $header, 'main' => $main, 'footer' => $footer]])
                         ->header('Access-Control-Allow-Origin', '*');
    }

    public function getList() {

        $alias = Input::get('alias', 'win');
        $sort  = Input::get('sort', 'asc');
        $page  = Input::get('page', 1);
        
        $itemModel = new Item();
        $lists = $itemModel->lists($alias, $sort, $page);

        $list = View::make('api.item.list')
                      ->with('alias', $alias)
                      ->with('sort', $sort)
                      ->with('lists', $lists)
                      ->render();

        return Response::json(['code'=>0, 'msg'=>'', 'data' => ['list' => $list]])
                         ->header('Access-Control-Allow-Origin', '*');;
    }

}
