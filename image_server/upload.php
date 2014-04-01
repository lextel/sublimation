<?php
/**
 * 上传
 *
 * @author  : weelion<weelion@qq.com>
 * @version : 1.0
 */

// TODO: api 密钥实现

// 只允许POST
// if(empty($_POST)) die('upload error');

$uris = getUris();
$keys = ['action', 'type'];
$params = array_combine($keys, $uris);

/**
 * 文件
 */
if(empty($_FILES)) {
    echo json_encode(['code' => 1, 'msg' => 'empty file']);
    exit();
}

/**
 * 验证类型
 */
if(!in_array($params['type'], $types)) {
    echo json_encode(['code' => 1, 'msg' => 'type error']);
    exit();
}

$filePaths = [];
foreach($_FILES as $key => $file) {
    if($file['error'] == 0 && isImage($file['tmp_name'])) {
        list($uploadPath, $filePath) = uploadPath($params['type'], $file['name']);
        move_uploaded_file($file['tmp_name'], $uploadPath);
        $filePaths[] = $filePath;
    }
}
if(count($filePaths) == count($_FILES) && count($filePaths) != 0) {
    echo json_encode(['code' => 0, 'msg' => 'ok', 'data' => $filePaths]);
} else {
    echo json_encode(['code' => 1, 'msg' => 'upload fail']);
}

exit();



