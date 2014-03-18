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
$(function (){
        // 邮箱验证   
      jQuery.validator.addMethod("isEmail", function(value) {
          var tel = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
          return tel.test(value);
      }, "is not email");
         
      // 手机号码验证
      jQuery.validator.addMethod("isMoble", function(value) {
          var tel = /^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/;
          return tel.test(value);
      }, "is not email");
  });