<?php

/** @var array $params */

use yii\web\UrlManager;

return [
    'class'               => UrlManager::class,
    'hostInfo'            => $params['hostInfo'],
    'enablePrettyUrl'     => true,
    'enableStrictParsing' => true,
    'showScriptName'      => false,
    'rules'               => [
        '' => 'v1/hello/index'
    ]
];