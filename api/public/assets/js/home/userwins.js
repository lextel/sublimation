	var pn = 0;
	//初始化
    $(document).on('pageinit', '#home', function(){
        var url = "http://192.168.4.220/u/wins/10";
        getAjaxData(url, userwins);
    });
    $ ( document ). delegate ( "div.pull-demo-page" , "pageinit" , function ( event ) {
		$ ( ".iscroll-wrapper" , this ). bind ( {
	  		"iscroll_onpullup": onPullUp
	 	});
	});

    function onPullUp(){
        pn += 10;
        var url = "http://192.168.4.220/u/wins/" + pn;
        getAjaxData(url, userwins);
    }
    
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
       //$("#more").remove();
       $.each(result.data.wins, function(i, row) {
                        var text = '<div class="item">';
                        text +=        '<div class="img-sm fl"><span class="img-wide"><a href="#"><img src="http://192.168.3.10/'+row.image+'" alt="美女" /></a></span></div>';
                        text +=        '<div class="info-wrap fr">';
                        text +=            '<div class="title">'+'( 第'+row.phase_id+'期 ) '+row.title+'</div>';
                        text +=            '<div class="price">价值：'+row.amount+'.00</div>';
                        text +=            '<div class="luckycode">幸运乐拍码:<s class="red">'+row.code+'</s></div>';
                        text +=            '<div class="datetime">揭晓时间:'+row.opentime+'</div>';
                        text +=            '<div class="btn-group">';
                        text +=                '<a href="" class="btn-pay">查看物流</a>';
                        text +=                '<a href="" class="btn-pay">查看晒单</a>';
                        text +=            '</div>';
                        text +=        '</div>';
                        text +=        '<div class="arrow-right fl"><a href=""><span class="icon-uniE600"></span></a></div>';
                        text +=      '</div>';
                        $('.owned-list').append(text);
                    });
       }
       