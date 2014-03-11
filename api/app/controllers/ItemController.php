<?php

class ItemController extends AppController {

    public function getIndex() {

        $title = "所有商品";

        $header = View::make('api.main_header')->with('title', $title)->render(); 
        $main   = View::make('api.item.index')->render();
        $footer = View::make('api.index_footer')->render();
        $script = View::make('api.item.script')->render();

        return Response::json(['header' => $header, 'main' => $main, 'footer' => $footer, 'script' => $script])
                         ->header('Access-Control-Allow-Origin', '*');
    }

    public function getAjaxIndex() {


        $list = View::make('api.item.list')->render();
    
        return Response::json(['list' => $list])
                         ->header('Access-Control-Allow-Origin', '*');;
    }

}
