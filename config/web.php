<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'admin', // required
        'log'
    ],
    'timeZone' => 'Asia/Tashkent',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@mdm/admin' => '@app/modules/admin'
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ]
    ],
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '860178683131-8p2981qqfgrumfnrqg1bodi86fo50r7l.apps.googleusercontent.com',
                    'clientSecret' => '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',
                    'returnUrl' => 'http://localhost/frontend/auth?authclient=google', // add this row
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '183972350815984',
                    'clientSecret' => '1c2090d1e049928862bf9990257c3b38',
                ]
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'EbbCYIjbotApwDtxPmNuAq5Zpwfyi_FQ',
            'baseUrl' => ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 30 * 60,
        ],
//        'view' => [
//            'theme' => [
//                'pathMap' => [
//                    '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
//                ],
//            ],
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'frontend/index',
                'index' => 'frontend/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/logout',
            'site/auth',
            'frontend/*',
//            'admin/*',
//            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
