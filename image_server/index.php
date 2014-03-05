<?php
/**
 * 图片服务入口
 *
 * @author : weelion<weelion@qq.com>
 * @version: 1.0
 */
include 'config.php';
include 'functions.php';

$uris = getUris();

if($uris[0] == 'upload') {
    /**
     * url 形式必须为:
     *    http://(host)/upload/(type)
     *
     *    host:    域名
     *    type:    图片类型 见 config.php
     *
     */
    include 'upload.php';
} else {

    /**
     * url形式必须为
     *    http://(host)/(type)/(size)/(path1)/(path2)/(filename)
     *
     *   host:     域名
     *   type:     图片类型见 config.php
     *   size:     尺寸 宽x高
     *   path1:    第一个目录
     *   path2:    第二个目录
     *   filename: 文件名
     */

    include 'image.php';
}
