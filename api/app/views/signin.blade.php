<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	
</head>
<body>

	<div class="welcome">
	
	    {{ Form::open(array('url' => 'signin'))}}
	    {{ Form::label('email', '邮箱地址')}}
		{{ Form::text('email')}}
		<br />
		{{ Form::label('password', '用户密码')}}
		{{ Form::password('password')}}
		<br />
		{{ Form::submit('我要登录')}}
		{{ Form::close()}}
	</div>
</body>
</html>
