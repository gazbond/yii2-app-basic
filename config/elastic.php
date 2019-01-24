<?php

return [
    'class' => 'yii\elasticsearch\Connection',
    'autodetectCluster' => false,
//    'auth' => [
//        'username' => '',
//        'password' => ''
//    ],
    'nodes' => [
        ['http_address' => 'elasticsearch:9200'],
        // configure more hosts if you have a cluster
    ],
];
