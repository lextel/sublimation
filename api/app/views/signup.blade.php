<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="description" content="An Icon Font Generated By IcoMoon.io">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/jquery.mobile-1.4.1.min.css"/>
    <link rel="stylesheet" href="../assets/css/style.css"/>
    <link rel="stylesheet" href="../assets/css/common.css"/>
    <script src="../assets/js/jquery-1.10.1.min.js"></script>
    <script src="../assets/js/jquery.mobile-1.4.1.min.js"></script>
</head>
<body>
<!--注册-->
<div data-role="page" id="register">
    <div data-role="header" class="hd-theme-b">
        <h1>注册</h1>
        <a href="" data-rel="back" class="ui-nodisc-icon ui-btn-left ui-btn  ui-btn-icon-notext" data-role="button">
            <span class="icon-arrow-left"></span>
        </a>
    </div>
    <div role="main" class="ui-content">
        <form action="/signup" id="registerForm" class="loginForm" method="post">
            <div class="fieldcontain">
                <label for="name"></label>
                <input  name="username" class="username" placeholder="请输入您的邮箱" type="text">
                <span class="icon-user icon-position"></span>
            </div>
            <div class="fieldcontain">
                <input  name="password" class="password" value="" placeholder="请输入您密码" type="password">
                <span class="icon-key icon-position"></span>
            </div>
            <div class="fieldcontain">
                <input  name="nickname" class="username" value="" placeholder="请输入您的昵称(8个字符以内)" type="text">
                <span class="icon-user icon-position"></span>
            </div>
            <div data-role="controlgroup">
                <!--<a href="" data-role="button" class="btn-theme-a">注册</a>-->
                <button data-role="button" class="btn-theme-a">注册</button>
            </div>
            <div class="fieldcontain">
                <label class="agree-bar">
                    <input type="checkbox" name="checkbox-0 " data-cacheval="true">我已阅读并同意
                    <a href="#agree" data-transition="slide">《乐乐淘服务协议》</a>
                </label>
            </div>
        </form>
    </div>
</div>
<!--用户协议-->
<div data-role="page" id="agree">
    <div data-role="header" class="hd-theme-b">
        <h1>服务协议</h1>
        <a href="" data-rel="back" class="ui-nodisc-icon ui-btn-left ui-btn  ui-btn-icon-notext" data-role="button">
            <span class="icon-arrow-left"></span>
        </a>
    </div>
    <div role="main" class="ui-content">
        <div class="agree-wrap">

        </div>
    </div>
</div>
</body>
</html>
