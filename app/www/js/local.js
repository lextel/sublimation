SERVER = 'http://192.168.3.10:82';

$(function(){

	$('a').click(function() {
		var target = $(this).attr('href');
		var tpl = $(this).attr('tpl');

		target = target.replace('SERVER', SERVER);

		console.log(target);

		if(typeof(tpl) != 'undefined' && target != 'javascript:;') {
			window.location.href='tpl_' + tpl + '.html?url=' + target;
		}

		return false;
	});

	render();
});

// 获取参数
function param(key) {
	return location.search.split(key+'=')[1];
}


// 渲染页面
function render() {
	var url = param('url');

	$.ajax({
		url: url,
		type: 'get',
		dataType: 'json',
		success: function(dom) {
			$('div[data-role="header"]').html(dom.header);
			$('div[data-role="main"]').html(dom.main);
			$('div[data-role="footer"]').html(dom.footer);
			console.log(dom);
		},
		error: function() {
			console.log('request error');
		}
	});

}