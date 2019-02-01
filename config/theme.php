<?php

return [
// Override module view files
    'pathMap' => [
        '@vendor/dektrium/yii2-user/views/mail/' => '@app/themes/user/mail/',
        '@vendor/dektrium/yii2-user/views/profile/' => '@app/themes/user/profile/',
        '@vendor/dektrium/yii2-user/views/recovery/' => '@app/themes/user/recovery/',
        '@vendor/dektrium/yii2-user/views/registration/' => '@app/themes/user/registration/',
        '@vendor/dektrium/yii2-user/views/security/' => '@app/themes/user/security/',
//        '@vendor/dektrium/yii2-rbac/views' => '@app/theme/rbac/views',
    ]
];
