$(function (){
	$(".addForm").validate({
        submitHandler:function(form){
		      /*var jsonData = {
		     	name:$("#").val(),postcode:$("#").val(),mobile:$("#").val(),
		     	provine:$("#").val(),city:$("#").val(),county:$("#").val(),address:$("#").val()
		     }
	         var json = {url: "signin" , type : "post" , datatype: "json" , data: jsonData };
	  	     if(ajaxdome(json)){
	   		 }*/
	   		 
         $.mobile.changePage( "/u" , {
          allowSamePageTransition: true,
          transition: "slideup" ,
          reverse: true ,
          pageContainer:function (){showMessage("xxxxx");},
          changeHash: true
        });
	   		 
	   		 //console.log(form);
        },
		    onfocusout:false,
        onkeyup:false,
        onclick:false,
        rules: {
            name: {
               required: true
            },
            mobile: {
               required: true
               //isMoble:  true
            },
            province: {
               required: true
            },
            city: {
               required: true
            },
            county: {
               required: true
            },
            address: {
               required: true
            },
            postcode: {
  
            }
        },
	    showErrors: function(errorMap, errorList) {
		    if(errorList.length > 0){
			    showMessage(errorList[0].message);
		    }
	    },
        messages: {
           name: {
              required: "请输入收件人姓名!"
           },
           mobile: {
              required: "请输入手机号!"
              //isMoble: "请输入正确到手机号!"
           },
           province: {
              required: "请选择省份!"
           },
           city: {
              required: "请选择城市!"
           },
           county: {
              required: "请选择地区!"
           },
           address: {
              required: "请填写正确到地址!"
           },
           postcode: {
              required: "请填写正确到邮编!"
           }
      }
  });
});