<?php
/**
 * 图片调用
 *
 * @author  : weelion<weelion@qq.com>
 * @version : 1.0
 */

// TODO: 错误时替换默认图片

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

/**
 * 验证size
 */
if($params['size'] != 'desc' || !preg_match('/^(\d+)x(\d+)$/', $params['size'])) die('size error');

// 原目录
$originalPath = UPLOAD.DS.$params['type'].DS.$params['path1'].DS.$params['path2'].DS.$params['filename'];

// 目标目录
$targetPath   = UPLOAD.DS.$params['type'].DS.$params['size'].DS.$params['path1'].DS.$params['path2'].DS.$params['filename'];

// 生成缩略图操作
if(!file_exists($targetPath)) {

    if($params['size'] == 'desc') die('file not exists');

    list($width, $height) = explode('x', $params['size']);
    
    $thumb = new Imagick();
    $thumb->readImage($originalPath);
    $thumb->resizeImage($width, $height, Imagick::FILTER_LANCZOS,1);
    $path = dirname($targetPath);
    checkDir($path);
    $thumb->writeImage($targetPath);
    $thumb->clear();
    $thumb->destroy(); 
}

header("Location: /uploads/{$params['type']}/{$params['size']}/{$params['path1']}/{$params['path2']}/{$params['filename']}");
