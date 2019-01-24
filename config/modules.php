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
];
