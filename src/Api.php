<?php

namespace YiHaiTao\Baison;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    private $key;

    private $secret;

    private $baseUrl;

    private $version = '3.0';

    public function __construct($key, $secret, $baseUrl)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->baseUrl = rtrim($baseUrl, '/') . '/?app_act=api/ec&app_mode=func';
    }

    /*
     * 请求百胜api
     *
     * string $serviceType 接口名,如e3oms.order.detail.add
     * array $data 业务参数
     */
    public function request(string $serviceType, array $data)
    {
        $http = $this->getHttp();
        $requestTime = date('YmdHis');
        $params = [
            'key' => $this->key,
            'requestTime' => $requestTime,
            'version' => $this->version,
            'serviceType' => $serviceType,
        ];
        $jsonData = json_encode($data);
        $params['data'] = $jsonData;
        $params['sign'] = $this->signature($requestTime, $serviceType, $jsonData);
        $response = call_user_func_array([$http, 'POST'], [$this->baseUrl, $params]);

        return json_decode($response->getBody(), true);
    }

    /*
     * 签名
     * string $requestTime 请求时间
     * string $serviceType 接口名称
     * string $jsonData 业务参数(json格式)
     */
    private function signature(string $requestTime, string $serviceType, string $jsonData)
    {
        $signStr = sprintf(
            'key=%s&requestTime=%s&secret=%s&version=%s&serviceType=%s&data=%s',
            $this->key,
            $requestTime,
            $this->secret,
            $this->version,
            $serviceType,
            $jsonData
        );
        return md5($signStr);
    }
}
