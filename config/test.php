<?php
/**
 * Application configuration for testing
 */
$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/web.php'),
    [
        'components' => [
            'db' => require(__DIR__ . '/test-db.php'),
            'elasticsearch' => require(__DIR__ . '/elastic-test.php'),
            'mailer' => [
                'useFileTransport' => true
            ],
            'urlManager' => [
                'showScriptName' => true,
                'enablePrettyUrl' => false
            ],
            'request' => [
                'enableCsrfValidation' => false,
                'enableCookieValidation' => false
            ]
        ],
    ]
);
$config['components']['log']['targets'] = [
    [
        'class' => 'yii\log\FileTarget',
        'levels' => ['error', 'warning', 'info'],
        'logVars' => [],
        'categories' => [
//            'yii\db\*',
//            'yii\web\HttpException:*',
            'app'
        ],
    ],
// log outputs to http response which breaks api route testing
//    [
//        'class' => 'app\components\ConsoleLogTarget',
//        'levels' => ['error', 'warning', 'info'],
//        'categories' => [
////                        'yii\db\*',
////                        'yii\web\HttpException:*',
//            'app'
//        ],
//    ],
];


return $config;
