<!DOCTYPE html>
<html>
<head>
    <title>账户明细</title>
    <meta charset="utf-8">
    <meta name="description" content="An Icon Font Generated By IcoMoon.io">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo asset('/assets/css/jquery.mobile-1.4.1.min.css');?>"/>
    <link rel="stylesheet" href="<?php echo asset('/assets/css/style.css');?>"/>
    <link rel="stylesheet" href="<?php echo asset('/assets/css/common.css');?>"/>
    <link rel="stylesheet" href="<?php echo asset('/assets/css/home/jquery.mobile-1.4.0-rc.1.min.css');?>"/>
    <link rel="stylesheet" href="<?php echo asset('/assets/css/home/jquery.mobile.iscrollview.css');?>"/>
    <link rel="stylesheet" href="<?php echo asset('/assets/css/home/jquery.mobile.iscrollview-pull.css');?>"/>
    <link rel="stylesheet" href="<?php echo asset('/assets/css/home/demo.css');?>"/>

    <script src="<?php echo asset('assets/js/jquery-1.10.1.min.js');?>"></script>
    <script src="<?php echo asset('assets/js/jquery.mobile-1.4.1.min.js');?>"></script>
    <script src="<?php echo asset('assets/js/common.js');?>"></script>
    <script src="<?php echo asset('assets/js/home/demo.js');?>"></script>
    <script src="<?php echo asset('assets/js/home/jquery.mobile-1.4.0-rc.1.min.js');?>"></script>
    <script src="<?php echo asset('assets/js/home/iscroll.js');?>"></script>
    <script src="<?php echo asset('assets/js/home/jquery.mobile.iscrollview.js');?>"></script>
    <script src="<?php echo asset('assets/js/home/pull-example.js');?>"></script>
    <script src="<?php echo asset('assets/js/home/userlog.js');?>"></script>

</head>
<body>
<!--设置-->
<div data-role="page" id="ownedDetail" class="pull-demo-page">
    
    <div data-role="header" class="hd-theme-b">
        <h1>账户明细</h1>
        <a href="" data-rel="back" class="ui-nodisc-icon ui-btn-left ui-btn  ui-btn-icon-notext" data-role="button">
            <span class="icon-arrow-left"></span>
        </a>
    </div>

    <div role="main" class="ui-content addressWrap">
        <div class="title">你当前可用的乐淘币为：<s class="red">0</s><a href="" class="btn-pay fr">去充值</a></div>
        
        <div  data-role="tabs" id="tabs">
            <div data-role="navbar" class="sort-bar">
                <ul>
                    <li><a href="#one" data-ajax="false"><p>消费记录</p><p><small>(消费乐淘币:<s class="red">20</s>)</small></p></a></li>
                    <li><a href="#two" data-ajax="false"><p>充值明细</p><p><small>(消费乐淘币:<s class="red">20</s>)</small></p></a></li>
                </ul>
            </div>

            <div id="one" class="item">
                    <div id="xp1" data-iscroll="" data-role="content">
                    <table data-role="table" id="table-custom1" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-popup-theme="a" data-column-btn-text="显示列...">
                        <tr class="ui-bar-d">
                            <th>时间</th>
                            <th data-priority="1">乐淘币</th>
                        </tr>
                    </table>

                    <div class="iscroll-pullup">
                        <span class="iscroll-pull-icon"></span><span class="iscroll-pull-label" data-iscroll-loading-text="Custom loading text" data-iscroll-pulled-text="Custom pulled text">Custom reset text</span>
                    </div>

                    </div>
            </div>

            <div id="two" class="item">
                <div id="xp2" data-iscroll="" data-role="content">
                <table data-role="table" id="table-custom2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="显示列..." data-column-popup-theme="a">
                    <thead>
                    <tr class="ui-bar-d">
                        <th data-priority="1">时间</th>
                        <th>渠道</th>
                        <th data-priority="2">金额</th>
                        <th data-priority="3">>乐淘币</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="iscroll-pullup">
                        <span class="iscroll-pull-icon"></span><span class="iscroll-pull-label" data-iscroll-loading-text="Custom loading text" data-iscroll-pulled-text="Custom pulled text">Custom reset text</span>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
