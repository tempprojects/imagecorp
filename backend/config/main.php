<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'components' => [
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
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-black',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/urlManager.php'),
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@backend/user/views',
                    '@dektrium/user/views/_element' => '@backend/views/_element'
                ],
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'modelMap' => [
//                'User' => 'backend\user\models\User',
//                'LoginForm' => 'backend\user\models\LoginForm',
            ],
            'controllerMap' => [
                'admin' => 'backend\user\controllers\AdminController',
                'registration' => 'backend\user\controllers\RegistrationController',
                'security' => 'backend\user\controllers\SecurityController',
                'recovery' => 'backend\user\controllers\RecoveryController',
            ],
//            'mailer' => [
//                'sender' => ['info@bigbet.pro' => 'Информационный отдел BIGBETPRO']
//            ],
        ],
    ],
    'params' => $params,
];
