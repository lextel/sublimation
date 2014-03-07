/*
*ShowMessage ：提示信息
*mag   :提示的值
*time  :提示时间毫秒，不写此参数默认为2000
*/
    function showMessage(mag,time){
        time = typeof time !== 'undefined' ? time : 2000;
        $.mobile.loading( 'show', {
        text: mag,
        textVisible: true,
        theme: "b",
        textonly: true
	   }).bind( "click", function() {
  	$.mobile.loading( "hide" );
    });
    var interval = setInterval(function (){
	  $.mobile.loading( "hide" );
	  clearTimeout(interval);  //关闭定时器
    	}, time);   
	}

   