<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'name' => 'Мануфакторинг',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
              'manufaktoring' => 'site/index',
              'torgovoe_predlzhenie' => 'site/salesoffer',
              '2200' => 'site/money2200',
              '1100' => 'site/money1100',
              'globalnye_dannye' => 'site/globaldata',
              'login' => 'site/login',
              'registraciya' => 'site/reg',
              'clients' => 'cabinet/index',
              'news' => 'cabinet/news',
              'dobavit_klienta' => 'cabinet/add',
              'edit/<edit:\d+>' => 'cabinet/edit',
            ],
        ],
        'assetManager' => [
             'basePath' => '@webroot/assets',
             'baseUrl' => '@web/assets'
        ],
         'request' => [
            'baseUrl' => ''
        ]

    ],
    'params' => $params,
];
