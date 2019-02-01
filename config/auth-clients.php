<?php

return [
    'stripe' => [
        'class' => 'app\components\StripeClient',
        'clientId' => '',
        'clientSecret' => '',
        'returnUrl' => 'http://localhost/user/auth?authclient=stripe',
    ],
    'github' => [
        'class'        => 'dektrium\user\clients\GitHub',
        'clientId'     => '',
        'clientSecret' => '',
        'returnUrl' => 'http://localhost/user/auth?authclient=github',
    ]
];