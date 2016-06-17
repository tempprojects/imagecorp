<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'response' => [
            'formatters' => [
                'xml' => 'common\components\XMLComponents',
                'xmlAviso' => 'common\components\XMLAvisoComponents',
                'xmlCheck' => 'common\components\XMLCheckComponents',
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableConfirmation' => false,
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
    ],
];
