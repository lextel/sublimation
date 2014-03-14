    function ajaxdome(jsonData){
	   $.ajax({
             url: jsonData.url,
	         type : jsonData.type,
             dataType: jsonData.dataType,
             //data: jsonData.data,
             success: function (obj){
             	$.each(obj.data.logs,function (datas,i){
             		$("#table-custom1").append("<tr><td>"+i.created_at+"</td><td>"+i.sum+"</td></tr>");
             	});        	
	     	 },
	     	 error : function (request,error){
		        showMessage("请求失败");
	            return false;
	         }
       });
	}


//moneylog
	function onPullUp(){
		var jsondata = { url : "buylog",type : "get" ,dataType: "json"};
		ajaxdome(jsondata);
	}


$ ( document ). delegate ( "div.pull-demo-page" , "pageinit" , function ( event ) {
	$ ( ".iscroll-wrapper" , this ). bind ( {
  		//"iscroll_onpulldown": onPullDown,
  		"iscroll_onpullup": onPullUp
 	});
});

