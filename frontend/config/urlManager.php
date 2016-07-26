<?php
return [
    '/' => '/site/index',

    'checkPay' => '/payment/check',
    'avisoPay' => '/payment/aviso',

    // USER
    'signup' => '/user/registration/register', // Displays registration form
    'resend' => '/user/registration/resend',   // Displays resend form
    'confirm' => '/user/registration/confirm', // Confirms a user (requires id and token query params)
    'sign' => '/user/security/login', // Displays login form
    'logout' => '/user/security/logout',// Logs the user out (available only via POST method)
    'recovery' => '/user/recovery/request',// Displays recovery request form
    'reset' => '/user/recovery/reset',// Displays password reset form (requires id and token query params)
   
    '<controller:[\w-]+>' => '<controller>/index',
    '<controller:\w+>/<element:\w+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
];