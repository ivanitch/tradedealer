<?php

use yii\caching\FileCache;
use yii\log\FileTarget;
use yii\web\JsonParser;

$params     = require __DIR__ . '/params.php';
$db         = require __DIR__ . '/db.php';
$urlManager = require __DIR__ . '/urlManager.php';

$config = [
    'id'                  => 'tradedealer-app',
    'basePath'            => dirname(__DIR__),
    'homeUrl'             => '/',
    'defaultRoute'        => 'hello/index',
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'App\Controller',
    'components'          => [
        'request'    => [
            'cookieValidationKey' => 'yA5FATSDaF1g1WwPiycAI1Y_9qJO7cJj',
            'parsers'             => [
                'application/json' => JsonParser::class,
            ],
        ],
        'user'       => [
            'identityClass'   => false,
            'enableAutoLogin' => false,
            'enableSession'   => false,
        ],
        'cache'      => [
            'class' => FileCache::class,
        ],
        'log'        => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'   => FileTarget::class,
                    'levels'  => ['error'],
                    'logFile' => '@runtime/logs/error.log',
                ],
                [
                    'class'   => FileTarget::class,
                    'levels'  => ['warning'],
                    'logFile' => '@runtime/logs/warning.log',
                ],
                [
                    'class'   => FileTarget::class,
                    'levels'  => ['info'],
                    'logFile' => '@runtime/logs/info.log',
                ],
            ],
        ],
        'db'         => $db,
        'urlManager' => $urlManager,
    ],
    'params'              => $params,
];

return $config;
