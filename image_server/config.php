<?php
 ini_set("display_errors",1);
 error_reporting(-1);


define('DS', DIRECTORY_SEPARATOR);
define('UPLOAD', __DIR__.DS.'upload');


/**
 * 图片类别
 *
 * banners:   横幅广告 用于幻灯片
 * items  :   商品图片
 * shares :   晒单图片
 * avatars:   用户头像
 */
$types = ['ad', 'item', 'post', 'avatar'];



