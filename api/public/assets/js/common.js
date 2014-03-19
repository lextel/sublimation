/*
*ShowMessage 定时显示信息
*mag   :提示信息
*time  :毫秒为单位显示时间
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
	  clearTimeout(interval);
    	}, time);   
	}