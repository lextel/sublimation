<<<<<<< HEAD
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
=======
SERVER = 'http://www.api.com';



$(document).bind("pageinit", function() {
    $.mobile.defaultPageTransition = "slide";

    $('a[data-render]').bind( "tap", function() {
        var tpl = $(this).attr('tpl');
        var href = $(this).attr('href');

        console.log('== INIT:' + href);

        href = enUrl(href);

        if(typeof(tpl) != 'undefined' && href != 'javascript:;') {
            $.mobile.changePage('tpl_' + tpl + '.html?url='+href);
        }

        return false;
    });

    $('div[data-role="page"]').bind( "pageshow", function() {
        render();
    });

});


// 处理url
function enUrl(url) {
    url = url.replace('?', '!');
    url = url.replace('&', '@');
    url = url.replace('=', '--');

    return url;
}

// 恢复url
function deUrl(url) {
    url = url.replace('!', '?');
    url = url.replace('@', '&');
    url = url.replace('--', '=');
    url = url.replace('SERVER', SERVER);

    return url;
}

// 获取参数
function param(key) {
    return document.location.search.split(key+'=')[1];
}


// 渲染页面
function render() {

    var url = param('url');

    console.log('== EXEC FUNC render');
    console.log(' -- debug param url:' + url);
    if(typeof(url) == 'undefined') {
        return ;
    }

    url = deUrl(url);
    console.log(' -- do render:' + url);
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(data) {
            if(data.code == 0) {
                $('div[data-role="header"]').html(data.data.header);
                $('div[data-role="content"]').html(data.data.main);
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
                $('.iscroll-list > div').html(data.data.list);
                $('.iscroll-list').iscrollview();
                $.mobile.activePage.find(".iscroll-wrapper").bind("iscroll_onpullup", function (event, data) {
                    var iscrollview = data.iscrollview,
                    listSelector = ".iscroll-list > div",
                    lastItemSelector = listSelector + " > div:last-child";

                    var page = $(this).attr('data-page');
                    nextPage = parseInt(page)+1;
                    url = url.replace(/\?page=\d+/, '', url);
                    url = url + '?page=' + nextPage;
                    var dom = getBlock(url, $(this), 'append');
                    $(listSelector).append(dom).listview("refresh"); 
                    iscrollview.refresh(null, null,
                      $.proxy(function afterRefreshCallback(iscrollview) { 
                        this.scrollToElement(lastItemSelector, 400); 
                        }, iscrollview) ); 

                } );
            } else {
                alert(data.msg);
            }
        }
    });
}

// 渲染块
function getBlock(url, target, type) {
    var dom = '';

    $.ajax({
        url: url,
        dataType: 'json',
        success:function(data) {
            if(data.code == 0) {
                dom = data.data.list;
                
            } else {
                alert(data.msg);
            }
        }
    });

    return dom;
}
>>>>>>> ec94402e961f6a5ce0dadc4e5d8c01b40d251bcf
