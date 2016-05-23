<?php
return [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'admin'],
    'components' => [
        'urlManager' => require(__DIR__.'/_urlManager.php'),
        'frontendCache' => require(Yii::getAlias('@frontend/config/_cache.php'))
    ],
];
