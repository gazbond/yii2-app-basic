<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com',
        'username' => '',
        'password' => '',
        'port' => '465',
        'encryption' => 'ssl',
    ],
    'messageConfig' => [
        'from' => ['' => ''],
        'charset' => 'UTF-8',
    ]
];
