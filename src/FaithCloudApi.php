<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 14:46
 */
// 目录入口
define('FAITHCLOUDAPI_ROOT_PATH', dirname(__FILE__));
require_once FAITHCLOUDAPI_ROOT_PATH . '/Common/FaithCloudApiBase.php';

class FaithCloudApi extends FaithCloudApiBase
{
    /**
     * 生成请求的URL，不发起请求
     * @param $path  string 请求路径
     * @param $params  array 请求参数
     * @return string
     */
    public function generateUrl($path, $params = [])
    {
        require_once FAITHCLOUDAPI_ROOT_PATH . '/Common/FaithCloudApiRequest.php';
        return FaithCloudApiRequest::generateUrl($path, $params, $this->_appId, $this->_appSecret, $this->_apiVersion);
    }

    /**
     * 生成请求的URL，发起请求
     * @param $path  string 请求路径
     * @param $params  array 请求参数
     * @return mixed
     */
    public function send($path, $params = [])
    {
        require_once FAITHCLOUDAPI_ROOT_PATH . '/Common/FaithCloudApiRequest.php';
        return FaithCloudApiRequest::send($path, $params, $this->_appId, $this->_appSecret, $this->_apiVersion);
    }
}