<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'error', 'warning'],
                    'categories' => ['quyennv'],
                    'logFile' => '@frontend/runtime/logs/quyennv.log',
                    'maxFileSize' => 1024 * 50,
                    'maxLogFiles' => 20,
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'thousandSeparator' => '.',
            'currencyCode' => 'VND',
        ],
    ],
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module'],
        // downloadAction: mixed, the action (url) used for downloading exported file.
        'downloadAction' => 'gridview/export/download',
        'charset' => 'utf8',
        'bsVersion' => '5.x',
        // i18n: array, the internalization configuration for this module.
        'i18n' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@gridview/messages',
            'forceTranslation' => true,
            'translations' => [
                'gridview' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/kartik-v/yii2-grid/messages',
                ],
            ],
        ],
        'gridview2' => ['class' => 'kartik\grid\Module'],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@common/media',
            'uploadUrl' => '@common/media',
            'imageAllowExtensions' => ['jpg', 'png', 'gif', 'jpeg']
        ],

    ],
    'language' => 'vi-VN',
    'timeZone' => 'Asia/Ho_Chi_Minh',
];
