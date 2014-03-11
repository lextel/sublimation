<!DOCTYPE html>
<html>
<head>
    <title>获得的商品</title>
    <meta charset="utf-8">
    <meta name="description" content="An Icon Font Generated By IcoMoon.io">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('/assets/css/jquery.mobile-1.4.1.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('/assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('/assets/css/common.css') }}"/>
    <script src="/assets/js/jquery-1.10.1.min.js"></script>
    <script src="/assets/js/jquery.mobile-1.4.1.min.js"></script>
    <script>
    var pn = 0;
    $(document).on('pageinit', '#home', function(){
        var url = "http://www.llt.com:81/u/userwinlist/20";
        getAjaxData(url, userwins);
    });
    $(document).on('vclick', '#more', function(){
        pn += 10;
        var url = "http://www.llt.com:81/u/userwinlist/" + pn;
        getAjaxData(url, userwins);
    });
    function getAjaxData(url, func){
        $.ajax({
                    url: url,
                    dataType: "json",
                    async: true,
                    success: function (result) {
                        if (result.code == 0){
                           func(result);
                        }else{
                           alert(result.msg);
                        }
                    },
                    error: function (request,error) {
                        alert('网络错误啦，请查看你的当地的网络!');
                    }
                }); 
    }
    function userwins(result){
       if (result.data.wins == []){
            var text = '<div class="noRecord"><span class="icon-spam"></span>暂时没有记录</div>';
            $('.owned-list').append(text);
            return;
       }
       $("#more").remove();
       $.each(result.data.wins, function(i, row) {
                        var text = '<div class="item">';
                        text +=        '<div class="img-sm fl"><span class="img-wide"><a href="#"><img src="http://192.168.3.10/'+row.image+'" alt="美女" /></a></span></div>';
                        text +=        '<div class="info-wrap fl">';
                        text +=            '<div class="title">'+'（第'+row.phase_id+'期）'+row.title+'</div>';
                        text +=            '<div class="price">价值：'+row.amount+'.00</div>';
                        text +=            '<div class="number">购买数量：<b class="red">50</b>人次</div>';
                        text +=            '<div class="btn-group">';
                        text +=                '<a href="" class="btn-pay">查看物流</a>';
                        text +=                '<a href="" class="btn-pay">查看晒单</a>';
                        text +=            '</div>';
                        text +=        '</div>';
                        text +=        '<div class="arrow-right fl"><a href=""><span class="icon-uniE600"></span></a></div>';
                        text +=      '</div>';
                        $('.owned-list').append(text);
                    });
       
       if (result.data.count>pn){
            var text = '<button id="more">加载更多啦</button>';
            $('.owned-list').append(text);
       }
       }
       
    </script>
</head>
<body>
<!--侧滑菜单-->
<div data-role="page" id="home">
    <div data-role="header" class="">
        <h1>获得的商品</h1>
        <a href="" data-rel="back" class="ui-nodisc-icon ui-btn-left ui-btn  ui-btn-icon-notext" data-role="button">
            <span class="icon-arrow-left"></span>
        </a>
    </div>
    <div role="main" class="ui-content owned-list">
        
    </div>
</div>

</body>
</html>
