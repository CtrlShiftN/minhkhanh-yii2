<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index2.php
            'showScriptName' => false,
            // Disable r = routes
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<action:(.*)>' => 'site/our-stories',
                'login' => 'site/login',
                'signup' => 'site/signup',
                'terms' => 'site/terms',
                'contact' => 'site/contact',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    //local
                    'clientId' => '271914200798-m49gjmr7a8rb2800bv21isu89nafsq4b.apps.googleusercontent.com',
                    'clientSecret' => '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',
//                    'returnUrl' => 'https://de-obelly.vn/frontend/web/access/auth?authclient=google',
                ],
//                'facebook' => [
//                    'class' => 'yii\authclient\clients\Facebook',
//                    'clientId' => '3063598503921263',
//                    'clientSecret' => 'c4a88957caf51b79584c2726077093b7',
//                    'returnUrl' => 'https://backend.com/access/auth?client=facebook',
//                ],
            ],
        ],
    ],
    'params' => $params,
];
