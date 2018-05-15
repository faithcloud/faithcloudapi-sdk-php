<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 16:03
 */
require_once FAITHCLOUDAPI_ROOT_PATH . '/Common/FaithCloudApiSign.php';

class FaithCloudApiRequest
{
    /**
     * api请求的服务器
     */
    const API_HOST = 'faithstudio.cn';

    /**
     * 校验公共参数
     * @param $paramArray
     * @param $appId
     * @return mixed
     */
    private static function checkPublicParams($paramArray, $appId)
    {
        if (!isset($paramArray['AppId'])) {
            $paramArray['AppId'] = $appId;
        }
        if (!isset($paramArray['Nonce'])) {
            $paramArray['Nonce'] = mt_rand(1,65535);
        }
        if (!isset($paramArray['Timestamp'])) {
            $paramArray['Timestamp'] = time();
        }
        return $paramArray;
    }

    /**
     * 发送请求并接收
     * @param $url
     * @return mixed
     */
    private static function sendRequest($url)
    {
        // 1. 初始化一个cURL会话
        $ch = curl_init();
        // 2. 设置请求选项, 包括具体的url
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // 3. 执行一个cURL会话并且获取相关回复
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * 生成请求url
     * @param $requestPath
     * @param $paramArray
     * @param $appId
     * @param $appSecret
     * @return string
     */
    public static function generateUrl($requestPath, $paramArray, $appId, $appSecret, $apiVersion)
    {
        $paramArray = self::checkPublicParams($paramArray, $appId);
        $plainText = FaithCloudApiSign::makeSignPlainText($requestPath,$paramArray);
        $paramArray['Signature'] = FaithCloudApiSign::sign($plainText,$appSecret);
        $requestPathArr = explode('/',$requestPath);
        $pathInfo = $requestPathArr[0] . '/' . $apiVersion . '.' . $requestPathArr[1] . '/' . $requestPathArr[2];
        $url = 'https://' . self::API_HOST . '/' . $pathInfo . '?' . http_build_query($paramArray);
        return $url;
    }

    /**
     * 发送请求
     * @param $requestPath
     * @param $paramArray
     * @param $appId
     * @param $appSecret
     * @return mixed
     */
    public static function send($requestPath, $paramArray, $appId, $appSecret, $apiVersion)
    {
        $url = self::generateUrl($requestPath,$paramArray,$appId,$appSecret, $apiVersion);
        return self::sendRequest($url);
    }
}