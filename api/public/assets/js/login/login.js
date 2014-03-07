     function LoginVerification(){
        if(!happy.email($("#log_email").val())){
            showMessage("邮箱格式错误！",3000);
            return false;}
        if(!happy.minmaxLength($("#log_password").val(),6,20)){
            showMessage("请输入6到20位密码",3000);
            return false;}
			
			//Response.ContentType = "application/json";
            //messageAjax("file:///F:/sublimation/api/public/html/login.html", {name: $("#log_email").val()} );
			
			$("#loginForm").submit();
        return true;
        }	
		
        function registerVerification(){
        if(!happy.email($("#reg_email").val())){
            showMessage("邮箱格式错误！",3000);
            return false;}
        if(!happy.minmaxLength($("#reg_password").val(),6,20)){
            showMessage("请输入6到20位密码",3000);
            return false;}
		if(!happy.maxLength($("#reg_nickname").val(),8)){
            showMessage("请输8个以内字符",3000);
            return false;}
		if($("#selCheckbox").is(":checked")){			
		    showMessage("请选中乐乐淘服务协议",3000);
            return false;}
			//Response.ContentType = "application/json";
            //messageAjax("file:///F:/sublimation/api/public/html/login.html", {name: $("#reg_email").val()} );
			
			$("#registerForm").submit();
        return true;
        }
		
		function  messageAjax(url,jsonData,fuc){
			//Response.ContentType = "application/json";
            $.post(url, jsonData ,fuc = function (obj){
				if(obj.code == '0'){
					showMessage(obj.meg,3000);
					return true;
				}
				else if(obj.code == '1'){
					showMessage(obj.meg,3000);
					return false;
				}
				else{
				    showMessage("验证失败",3000);
					return false;
				}
            });
		}

