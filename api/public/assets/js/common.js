/*
*ShowMessage £ºÌáÊ¾ÐÅÏ¢
*mag   :ÌáÊ¾µÄÖµ
*time  :ÌáÊ¾Ê±¼äºÁÃë£¬²»Ð´´Ë²ÎÊýÄ¬ÈÏÎª2000
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
	  clearTimeout(interval);  //¹Ø±Õ¶¨Ê±Æ÷
    	}, time);   
	}