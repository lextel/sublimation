<!DOCTYPE html>
<html>
<head>
    <title>地址管理</title>
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
<!--添加地址-->
<div data-role="page" id="addAddress">
    <div data-role="header" class="hd-theme-b">
        <h1>添加地址</h1>
        <a data-rel="back" class="ui-nodisc-icon ui-btn-left ui-btn  ui-btn-icon-notext" data-role="button">
            <span class="icon-arrow-left"></span>
        </a>
    </div>
    <div role="main" class="ui-content owned-detail">
        <form method="post" action="" class="addForm">
            <label for="ftitle">收件人:</label>
            <input type="text" name="name" id="ftitle" class="text" placeholder="请输入收货人姓名" value="{{$address->name}}">
            <label for="phone">手机号码:</label>
            <input type="text" name="mobile" id="phone" class="text" placeholder="请输入收货人手机号码">
            <label for="province">省份:</label>
            <input type="text" name="province" id="province" class="text" placeholder="请选择省份">
            <label for="city">城市:</label>
            <input type="text" name="city" id="city" class="text" placeholder="请选择城市">
            <label for="Region">地区:</label>
            <input type="text" name="county" id="Region" class="text" placeholder="请选择地区">
            <label for="address">详细地址:</label>
            <input type="text" name="address" id="address" class="text" placeholder="请填写街道地址">
            <label for="address">邮政编码:</label>
            <input type="text" name="postcode" id="address" class="text" placeholder="请填写邮编（非必要）">
            <input type="checkbox" class="checkbox" name="rate" id="checkbox-0" data-mini="true">
            <label for="checkbox-0">设为默认地址</label>
        </form>
    </div>
    <div data-role="footer" class="ui-footer ui-bar-inherit" role="contentinfo">
        <div class="pay-box"><a href="" class="btn-pay-for ui-link">保存</a></div>
    </div>
</div>
</body>
</html>
