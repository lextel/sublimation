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

    /**
     * 获取期数列表
     *
     */
    public function phaseIds($id) {

        $phase = Phase::find($id)->toArray();

        $ids = Phase::where('item_id', $phase['item_id'])->select('phase_id')->get()->toArray();

        $formatIds = [];
        foreach($ids as $id) {
            $formatIds[] = $id['phase_id'];
        }

        return array_reverse($formatIds);
    }

    /**
     * 上期获奖信息
     *
     * @param $phaseId int 期数ID
     * @param $itemId  int 商品ID
     *
     * @return array
     */
    public function lastWin($phaseId, $itemId) {
        $data = Phase::whereRaw("item_id = {$itemId} and id < {$phaseId}")
                      ->orderBy('id', 'desc')
                      ->take(1)
                      ->get(['member_id', 'code', 'remain', 'id'])
                      ->toArray();
        $data = array_shift($data);

        if( !isset($data['code']) || !isset($data['remain']) || !isset($data['member_id']) ||
            $data['code'] == '' || $data['remain'] != 0 || $data['member_id'] == 0) {
            return [];
        }

        $member = Member::where('id', $data['member_id'])->get(['nickname', 'ip'])->toArray();
        $data['memberInfo'] = array_shift($member);

        $data['orderInfo'] = Order::whereRaw("phase_id = {$data['id']} and member_id = {$data['member_id']} and codes like '%{$data['code']}%'")
                             ->get(['ordered_at', 'code_count'])->toArray();

        $data['postCount'] = Post::whereRaw("item_id = {$itemId} and status = 1 and is_delete = 0")->count();
        $data['commentCount'] = Comment::whereRaw("item_id = {$itemId} and status = 1 and is_delete = 0")->count();

        return $data;
    }

    /**
     * 获取商品详情
     */
    public function view($id) {
        $data = Phase::where('id', $id)->get(['id', 'item_id', 'title', 'cost', 'remain', 'joined', 'amount'])->toArray();
        $data = array_shift($data);

        $data['phaseIds'] = $this->phaseIds($id);
        $data['images'] = unserialize(Item::find($data['item_id'])->toArray()['images']);
        $data['lastWin'] = $this->lastWin($id, $data['item_id']);

        return $data;
    }

    /**
     * 所有订单
     */
    public function order($id, $page) {

        $pagesize = OrderClass::$pagesize;
        $skip = ($page-1) * $pagesize;
        $orders = Order::where('phase_id', $id)
                     ->orderBy('id', 'desc')
                     ->skip($skip)
                     ->take($pagesize)
                     ->get(['code_count', 'ordered_at', 'member_id'])
                     ->toArray();

        $memberIds = [];
        foreach($orders as $order) {
            $memberIds[] = $order['member_id'];
        }

        $memberModel = new Member();
        $members = $memberModel->byIds($memberIds);

        $data = [];
        foreach($orders as $k => $order) {
            $data[$k] = $order;
            $data[$k]['memberInfo'] = $members[$order['member_id']];
        }

        return $data;
    }

    /**
     * 详情
     */
    public function info($phaseId) {

        $phase = Phase::find($phaseId)->toArray();

        $data = [];
        if($phase) {
            $item = Item::where('id', $phase['item_id'])->get(['desc'])->toArray();
            $data = array_shift($item);
        }

        return $data;
    }

}
