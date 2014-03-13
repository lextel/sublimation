SERVER = 'http://www.llt.com:81';

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
        success: function(data) {
            if(data.code == 0) {
                $('div[data-role="header"]').html(data.data.header);
                $('div[role="main"]').html(data.data.main);
                $('div[data-role="footer"]').html(data.data.footer);

                // 请求列表
                if($('div[role="list"]').length > 0) {
                    getList();
                }
            } else {
                alert(data.msg);
            }
        },
        error: function() {
            alert('请求失败');
        }
    });
}

// 渲染列表
function getList() {
    var url = $('div[role="list"]').attr('url');

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(data) {
            if(data.code == 0) {
                $('div[role="list"]').html(data.data.list);
            } else {
                alert(data.msg);
            }
        }
    });
}

// 渲染块
function getBlock() {
}
