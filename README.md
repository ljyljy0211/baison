# 百胜E3OMS SDK

[http://e3oms.open.baison.net](http://e3oms.open.baison.net "百胜E3OMS开放平台文档")

## 安装

```shell
$ composer require yihaitao/baison -vvv
```

## 使用

```php
<?php

use YiHaiTao\Baison\Baison;

$config = [
    'key' => 'your-key',
    'secret' => 'your-secret',
    'base_url' => ' https://xxx.xxx.xxx/e3/webopm/web/?app_act=api/ec&app_mode=func',
];

// 实例化百胜E3OMS SDK
$baison = new Baison($config);
// 使用如下
$baison->request('serviceType', $params);

// 例子
$result = $baison->request('e3oms.order.detail.add', $params);
print_r($result);
```

## License

MIT
