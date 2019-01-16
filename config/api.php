<?php
/**
 * Application configuration for testing
 */
$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/web.php'),
    [
        'layout' => 'api',
        'defaultRoute' => 'api',
        'components' => [
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'request' => [
                'enableCsrfValidation' => false,
                'enableCookieValidation' => false
            ],
            'urlManager' => [
                'showScriptName' => false,
                'enablePrettyUrl' => true,
                'rules' => [
                    ['class' => 'yii\rest\UrlRule', 'controller' => '/api/users'],
                ],
            ],
        ],
    ]
);
$config['modules'] = [
    'api' => [
        'class' => 'app\modules\api\Module',
    ],
    // Needed for authentication
    'user' => [
        'class' => 'dektrium\user\Module',
        'modelMap' => [
            'User' => 'app\models\User',
        ],
        'adminPermission' => 'admin',
        // TODO Stub out controllers not working
        'controllerMap' => [
            'user/admin' => false,
            'user/profile' => false,
            'user/recovery' => false,
            'user/registration' => false,
            'security' => false,
            'user/settings' => false,
        ]
    ],
];
$config['components']['log']['targets'] = [
    [
        'class' => 'yii\log\FileTarget',
        'levels' => ['error', 'warning', 'info'],
        'logVars' => [],
        'categories' => [
//            'yii\web\HttpException:*',
//            'application',
            'app'
        ],
    ],
];
return $config;