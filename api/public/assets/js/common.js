/*
*ShowMessage ����ʾ��Ϣ
*mag   :��ʾ��ֵ
*time  :��ʾʱ����룬��д�˲���Ĭ��Ϊ2000
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
	  clearTimeout(interval);  //�رն�ʱ��
    	}, time);   
	}

   