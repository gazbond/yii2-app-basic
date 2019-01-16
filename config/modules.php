<?php

return [
    'api' => [
        'class' => 'app\modules\api\Module',
    ],
    'user' => [
        'class' => 'dektrium\user\Module',
        'modelMap' => [
            'User' => 'app\models\User',
        ],
        'adminPermission' => 'admin'
    ],
    'rbac' => [
        'class' => 'dektrium\rbac\RbacWebModule'
    ],
    'settings' =>  [
        'class'=>'yii2mod\settings\Module',
        'as access' => [
            'class' => 'yii\filters\AccessControl',
            'ruleConfig' => [
                'class' => 'dektrium\user\filters\AccessRule',
            ],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['admin']
                ],
            ]
        ]
    ],
];
