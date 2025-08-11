<?php

/** @var array $params */

use yii\rest\UrlRule;
use yii\web\UrlManager;

return [
    'class'               => UrlManager::class,
    'enablePrettyUrl'     => true,
    'enableStrictParsing' => true,
    'showScriptName'      => false,
    'rules'               => [
        'GET api/v1/cars'             => 'v1/car/index',
        'GET api/v1/cars/<id:\d+>'    => 'v1/car/view',
        'GET api/v1/credit/calculate' => 'v1/credit/calculate',
    ],
];