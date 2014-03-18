    function ajaxdome(jsonData,id){
	   $.ajax({
            url: jsonData.url,
	        type : jsonData.type,
            dataType: jsonData.dataType,
            success: function (obj){
            	if(obj.data.logs.length<1){
					showMessage("暂时没有纪录!");
				}
				if(id =="one"){
					$.each(obj.data.logs,function (datas,i){
             			$("#table-custom1").append("<tr><td>"+i.created_at+"</td><td>"+i.sum+"</td></tr>");
             		});
				}
				if(id =="two"){
					$.each(obj.data.logs,function (datas,i){
             			$("#table-custom2").append("<tr><td>"+i.created_at+"</td><td>"+i.source+"</td><td>"+i.sum+"</td><td>"+i.sum+"</td></tr>");
             		});
				}
            },
	     	error : function (request,error){
		       showMessage("请求失败");
	           return false;
	        }
       });
	}
	//消费记录AJAX
	function onPullUpConsumption(){
		var jsondata = { url : "buylog",type : "get" ,dataType: "json"};
		ajaxdome(jsondata,"one");
	}

	//充值明细ajax
	function onPullUpRecharge(){
		var jsondata = { url : "moneylog",type : "get" ,dataType: "json"};
	    ajaxdome(jsondata,"two");
	}
	
	$ ( document ). delegate ( "div.pull-demo-page" , "pageinit" , function ( event ) {
		$ ( "#one .iscroll-wrapper" , this ). bind ( {
	  		//"iscroll_onpulldown": onPullDown,
	  		"iscroll_onpullup": onPullUpConsumption
	 	});
	 	$ ( "#two .iscroll-wrapper" , this ). bind ( {
	 		"iscroll_onpullup": onPullUpRecharge
	 	});
	});
	//初始化data
	$(function (){
		onPullUpConsumption();
		onPullUpRecharge();
	})