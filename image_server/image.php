<?php
/**
 * 图片调用
 *
 * @author  : weelion<weelion@qq.com>
 * @version : 1.0
 */

// TODO: 错误时替换默认图片

// handle desc
if(isset($uris[2]) && $uris[2] == 'desc') {
    $originalPath = UPLOAD.DS.$uris[1].DS.$uris[2].DS.$uris['3'].DS.$uris[4].DS.$uris[5];
    if(!file_exists($originalPath)) {
        header("Location: /upload/nopic.gif");
    }
}

$keys = ['type', 'size', 'path1', 'path2', 'filename'];
$params = array_combine($keys, $uris);

/**
 * 验证参数
 */ 
if(!$params) die('params error'); 

/**
 * 验证类型
 */
if(!in_array($params['type'], $types)) die('type error');

if($params['type'] == 'ad') {
    header("Location: /upload/{$params['type']}/{$params['path1']}/{$params['path2']}/{$params['filename']}");
}

/**
 * 验证size
 */
if( !preg_match('/^(\d+)x(\d+)$/', $params['size'])) die('size error');

// 原目录
$originalPath = UPLOAD.DS.$params['type'].DS.$params['path1'].DS.$params['path2'].DS.$params['filename'];

// 目标目录
$targetPath   = UPLOAD.DS.$params['type'].DS.$params['size'].DS.$params['path1'].DS.$params['path2'].DS.$params['filename'];

// 生成缩略图操作
if(!file_exists($targetPath) && file_exists($originalPath)) {

    if($params['size'] == 'desc') die('file not exists');

    list($width, $height) = explode('x', $params['size']);
    if($params['type'] == 'post') {
        $im = new imagick($originalPath);
        $imageprops = $im->getImageGeometry();
        $w  = $imageprops['width'];
        $h = $imageprops['height'];
        if($w > $h){
            $height = $h / $w / $width;
        }elseif($width == $height) {
        } else {
            if(empty($height)) { 
                $height = $h / $w / $width;
            } else 
                $width = $w / ($h / $height);
        }
    }
    
    $thumb = new Imagick($originalPath);
    //$thumb->cropThumbnailImage($width, $height, Imagick::FILTER_LANCZOS,1);
    $thumb->cropThumbnailImage($width, $height);
    $path = dirname($targetPath);
    checkDir($path);
    $thumb->writeImage($targetPath);
    $thumb->clear();
    $thumb->destroy(); 
}

if(!file_exists($originalPath)) {
    header("Location: /upload/nopic.gif");
} else {
    header("Location: /upload/{$params['type']}/{$params['size']}/{$params['path1']}/{$params['path2']}/{$params['filename']}");
}
