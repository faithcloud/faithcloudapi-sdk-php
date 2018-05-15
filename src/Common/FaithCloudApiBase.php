<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2018/2/9
 * Time: 14:55
 */

abstract class FaithCloudApiBase
{
    /**
     * ApiVersion
     * @var string
     */
    protected $_apiVersion = '';
    /*
     * AppId
     * @var string
     */
    protected $_appId = '';

    /**
     * AppSecret
     * @var string
     */
    protected $_appSecret = '';

    /**
     * TakecloudApiBase constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        if (!empty($config)) {
            $this->setConfig($config);
        }
    }

    /**
     * 设置配置
     * @param $config
     * @return bool
     */
    public function setConfig($config)
    {
        if (!is_array($config) || empty($config)) {
            return false;
        }
        foreach ($config as $key => $value) {
            switch ($key) {
                case 'AppId':
                    $this->setConfigAppId($value);
                    break;

                case 'AppSecret':
                    $this->setConfigAppSecret($value);
                    break;

                case 'ApiVersion':
                    $this->setConfigApiVersion($value);
                    break;
            }
        }
        return true;
    }

    /**
     * 设置AppId
     * @param $appId
     * @return $this
     */
    public function setConfigAppId($appId)
    {
        $this->_appId = $appId;
        return $this;
    }

    /**
     * 设置AppSecret
     * @param $appSecret
     * @return $this
     */
    public function setConfigAppSecret($appSecret)
    {
        $this->_appSecret = $appSecret;
        return $this;
    }

    /**
     * 设置api版本
     * @param $apiVersion
     * @return $this
     */
    public function setConfigApiVersion($apiVersion)
    {
        $this->_apiVersion = $apiVersion;
        return $this;
    }
}