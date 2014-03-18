<?php

class CartController extends AppController {

    // 购物车列表
    public function getIndex() {

        $title = "购物车";

        $itemModel = new Item();
        $cartItems = $itemModel->cart();

        $header = View::make('api.main_header')->with('title', $title)->render(); 
        $main   = View::make('api.cart.index')->with('cartItems', $cartItems)->render();
        $footer = View::make('api.index_footer')->render();

        return Response::json(['code'=>0 ,'msg' => '', 'data' => ['header' => $header, 'main' => $main, 'footer' => $footer]])
                         ->header('Access-Control-Allow-Origin', '*');
    }

    // 添加购物车
    public function postIndex() {

        $id  = Input::post('id', 0);
        $qty = Input::post('qty', 0);
        $name = Input::post('name', '');
        $price = Input::post('price', 0.00);

        $result = ['code' => 1, 'msg' => '添加失败'];
        if(!empty($id) && !empty($qty) && !empty($name) && !empty($price)) {
            Cart::add(['id' => $id, 'qty' => $qty, 'name' => $name, 'price' => $price]);

            $result = ['code' => 0, 'msg' => '添加成功'];
        }

        return Response::json($result)->header('Access-Control-Allow-Origin', '*');
    
    }

    // 修改数量
    public function putModify() {
        $id = Input::put('id');  // rowId
        $qty = Input::put('qty');


        $rs = false;
        $result = ['code' => 1, 'msg' => '更新失败'];
        if(!empty($id) && !empty($qty)) {
            $rs = Cart::update($id, ['qty' => $qty]);
        }

        if($rs) {
            $result = ['code' => 0, 'msg' => '更新成功'];
        }

        return Response::json($result)->header('Access-Control-Allow-Origin', '*');
    }

    // 删除商品
    public function deleteRemove() {
        $id = Input::delete('id'); // rowId

        $rs = false;
        $result = ['code' => 1, 'msg' => '删除失败'];
        if(!empty($id)) {
            Cart::remove($id);
            $result = ['code' => 0, 'msg' => '删除成功'];
        }

        return Response::json($result)->header('Access-Control-Allow-Origin', '*');
    }

    // 结算验证
    public function getCheck() {

        $itemModel = new Item();
        $pass = $itemModel->cartCheck();

        $result = ['code' => 1, 'msg' => '购物车中有过期商品'];
        if($pass) {
            $result = ['code' => 0, 'msg' => '提交中...'];
        }

        return Response::json($result)->header('Access-Control-Allow-Origin', '*');
    }

    // 支付插件验证
    public function getCheckPay() {
        // TODO 等支付

    }

    // 订单页面
    public function getOrder() {

        $title = "结算";

        $items = Cart::content();
        $header = View::make('api.main_header')->with('title', $title)->render(); 
        $main   = View::make('api.cart.order')->with('items', $items)->render();
        $footer = View::make('api.index_footer')->render();

        return Response::json(['code'=>0 ,'msg' => '', 'data' => ['header' => $header, 'main' => $main, 'footer' => $footer]])


    }

    // 支付
    public function getPay() {

    }

    // 测试
    public function getTest() {

        Cart::add(['id' => 23, 'name' => '测试商品', 'price' => '186.00', 'qty' => 1]);
        return 'ok';
    }
}
