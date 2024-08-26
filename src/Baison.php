<?php

namespace YiHaiTao\Baison;

use Hanson\Foundation\Foundation;

class Baison extends Foundation
{
    public function __construct($config)
    {
        $config['debug'] = $config['debug'] ?? false;
        parent::__construct($config);
    }

    public function request($serviceType, $params)
    {
        $api = new Api($this->config['key'], $this->config['secret'], $this->config['base_url']);
        return $api->request($serviceType, $params);
    }
}
