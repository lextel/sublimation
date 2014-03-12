<!DOCTYPE html>
<html>
<head>
    <title>我的乐拍</title>
    <meta charset="utf-8">
    <meta name="description" content="An Icon Font Generated By IcoMoon.io">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/jquery.mobile-1.4.1.min.css"/>
    <link rel="stylesheet" href="/assets/css/style.css"/>
    <link rel="stylesheet" href="/assets/css/common.css"/>
    <script src="/assets/js/jquery-1.10.1.min.js"></script>
    <script src="/assets/js/jquery.mobile-1.4.1.min.js"></script>
</head>
<body>
<!--侧滑菜单-->
<div data-role="page">
    <div data-role="header" class="hd-theme-b">
        <h1>我的乐拍</h1>
        <a href="" data-rel="back" class="ui-nodisc-icon ui-btn-right ui-btn  ui-btn-icon-notext" data-role="button">
            <span class="icon-cog"></span>
        </a>
    </div>
    <div role="main" class="ui-content">
        <ul class="userInfo">
            <li>
                <div class="portrait fl">
                    <img src="http://192.168.3.10/{{$res['avatar']}}" alt="头像"/>
                </div>
                <span class="username fl"><b>{{$res['nickname']}}</b></span>
            </li>
            <li>
                <div class="money fl">可用乐淘币<b class="red">{{ $res['points'] }}</b>个</div>
                <a href="" class="ui-mini btn-pay fr">去充值</a>
            </li>
        </ul>
        <div class="link-menu">
            <ul>
                <li><a href="">我的乐拍 <i class="icon-uniE600 fr"></i></a></li>
                <li><a href="/u/winlist">获得的商品<s>{{ $res['unreadcount'] }}</s><i class="icon-uniE600 fr"></i></a></li>
                <li><a href="">我的晒单<s>{{ $res['unreadcount'] }}</s><i class="icon-uniE600 fr"></i></a></li>
                <li><a href="/u/log">账户明细<i class="icon-uniE600 fr"></i></a></li>
                <li><a href="/u/address">收货地址管理<i class="icon-uniE600 fr"></i></a></li>
            </ul>
        </div>
    </div>
    <div data-role="footer" class="page-theme-a ui-footer-fixed">
        <div data-role="navbar">
            <ul>
                <li><a href=""><span class="icon-home bl"></span>首页</a></li>
                <li><a href=""><span class="icon-grid bl"></span>所有商品</a></li>
                <li><a href=""><span class="icon-cart2 bl"></span>购物车</a></li>
                <li><a href=""><span class="icon-user bl"></span>我的</a></li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
