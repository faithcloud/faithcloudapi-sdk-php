<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 16:49
 */
// 设置http头返回json格式
header('Content-type: application/json');

require_once './src/FaithCloudApi.php';

$config = [
    'ApiVersion' => 'schoolV2',
    'AppId' => 'fc_s_5afa9c8d7b566',  // 您的appId
    'AppSecret' => '6c713cc9c2616fbd6216c5dfaceabc1a'  // 您的appSecret
];

$app = new FaithCloudApi($config);
$ret = $app->send('admin/user/getUserList',[
    'pageIndex' => 1,
    'pageSize' => 10
]);
echo $ret;