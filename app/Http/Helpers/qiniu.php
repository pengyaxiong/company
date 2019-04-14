<?php
use Qiniu\Auth;

// 引入上传类
use Qiniu\Storage\UploadManager;

/**
 * 上传到七牛
 * @param $filePath 文件的绝对路径
 * @return array ['文件信息', '错误信息']
 * @throws Exception
 */
function qiniu_upload($file_path)
{
    $accessKey = env('QNAK');
    $secretKey = env('QNSK');

    // 构建鉴权对象
    $auth = new Auth($accessKey, $secretKey);

    // 要上传的空间
    $bucket = env('QNBUCKET');

    // 生成上传 Token
    $token = $auth->uploadToken($bucket);

    // 上传到七牛后保存的文件名
    $key = basename($file_path);

    // 初始化 UploadManager 对象并进行文件的上传
    $uploadMgr = new UploadManager();

    // 调用 UploadManager 的 putFile 方法进行文件的上传
    $uploadMgr->putFile($token, $key, $file_path);

    //删除本地图片
    unlink($file_path);
}
