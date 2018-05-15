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
    'ApiVersion' => 'communityV2',
    'AppId' => 'fc_c_5afab9f3bb9c8',  // 您的appId
    'AppSecret' => 'b54d6298782ecdf2599016221e32a9c3'  // 您的appSecret
];

$app = new FaithCloudApi($config);
$ret = $app->send('admin/department/getDepartmentList',[
]);
echo $ret;