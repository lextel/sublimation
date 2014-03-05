<?php
/**
 * 公共函数
 *
 * @author : weelion<weelion@qq.com>
 * @version: 1.0
 */

/**
 * 获取uris
 *
 * @return array
 */
function getUris() {

    $uri = $_SERVER["REQUEST_URI"];
    $realUri = trim($uri, '/');
    $realUri = str_replace('..', '', $realUri);

    return $uris = explode('/', $realUri);
}

/**
 * 获取图片上传目标路径
 *
 * @param $type 图片类型
 * @param $name 图片名称
 *
 * @return string
 */
function uploadPath($type, $name) {

    $info = pathinfo($name);
    $hash = md5($info['filename']);
    $path = UPLOAD.DS.$type.DS.$hash[0].DS.$hash[1].DS;
    $filename = $hash.'.'.$info['extension'];

    checkDir($path);

    return [$path.$filename, $hash[0].DS.$hash[1].DS.$filename];
}

/**
 * 检查目录
 *
 * 如果没有创建则创建目录
 *
 * @param $path string 路径
 *
 * @return void
 */
function checkDir($path) {

    if(!file_exists($path)) {
        mkdir($path, 0755, true);
    }
}


/**
 * 是否是gif、jpg、ng图片检验 
 *
 * @param $path 路径
 *
 * @return boolean
 */
function isImage($path) {
    list(, , $type) = getimagesize($path);

    switch ($type) {
            case IMAGETYPE_GIF:
                break;
            case IMAGETYPE_JPEG:
                break;
            case IMAGETYPE_PNG:
                break;
            default:
                return false;
    }

    return true;
}
