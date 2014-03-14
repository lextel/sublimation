    function ajaxdome(jsonData){
	   $.ajax({
             url: jsonData.url,
	     type : jsonData.type,
             dataType: jsonData.dataType,
             data: jsonData.data,
             success: function (obj){
		  if(obj.code == '0'){
                      showMessage(obj.msg);
		      return true;
                  }
                  if(obj.code == '1'){
                      showMessage(obj.msg);
                      return false;
                  }
	     },
	     error : function (request,error){
		showMessage("请求失败");
	        return false;
	     }
           });
	}




$().ready(function(){

	// 邮箱验证   
        jQuery.validator.addMethod("isEmail", function(value) {
           var tel = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
           return tel.test(value);
        }, "is not email");
	

	// 邮箱ajax验证
        jQuery.validator.addMethod("isAjaxEmail", function(value) {
	    json = {url: "signin" , type : "post" , dataType : "json" , data: value }
	    return ajaxdome(json);
        }, "is not email");

	
       // 昵称ajax验证
        jQuery.validator.addMethod("isAjaxNickname", function(value) {
	      json = {url: "signin" , type : "post" , datatype : "json" , data: value }
	  return ajaxdome(json);
        }, "is not email");



	//登录
        $("#loginForm").validate({
           submitHandler:function(form){
		   var jsonData = {username: $("#username").val() , password : $("#password").val()};
	       var json = {url: "signin" , type : "post" , datatype: "json" , data: jsonData };
	  	   if(ajaxdome(json)){
	 			window.location.href='/u';
	   		}
        },
		onfocusout:false,
        onkeyup:false,
        onclick:false,
        rules: {
            username: {
               required: true,
               isEmail : true 
            },
            password: {
               required: true,
	       rangelength: [6, 20]
           }
        },
	showErrors: function(errorMap, errorList) {
		if(errorList.length > 0){
			showMessage(errorList[0].message);
		}
	},
        messages: {
           username: {
              required: "邮箱不能为空 !",
              isEmail: "邮箱格式错误!"
           },
           password: {
              required: "密码不能为空!",
	      rangelength: "密码必须在6-20个字符之间！"
          }
        }
    });

 

      //注册
      $("#registerForm").validate({
        submitHandler:function(form){
	   	   var jsonData = {username: $("#regusername").val() , password : $("#regpassword").val() , nickname : $("#regnickname").val()};
	       var json = {url: "signUp" , type : "post" , datatype: "json" , data: jsonData };
	       if(ajaxdome(json)){
	   	   	  window.location.href='/u';
	       }
        },
        onfocusout:false,
        onkeyup:false,
        onclick:false,
        rules: {
            username: {
               required: true,
               isEmail: true,
               isAjaxEmail: true
            },
            password: {
               required: true,
	        rangelength: [6, 20]
            },
	    	nickname: {
               required: true,
               maxlength:8
            }
        },
	showErrors: function(errorMap, errorList) {
		if(errorList.length > 0){
			showMessage(errorList[0].message);
		}
	},
        messages: {
           username: {
              required: "邮箱不能为空!",
              isEmail: "邮箱格式错误",
              isAjaxEmail: "邮箱已存在!"
           },
           password: {
              required: "密码不能为空!",
	      	  rangelength: "密码必须在6-20个字符之间！"
           },
           nickname: {
	      	  required : "昵称不能为空!",
              maxlength: "昵称不能超过8个字符！"
           }
        }
    });

});