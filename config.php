<?php

use digitalAscetic\humhub\modules\authtokenqueryparam\Events;
use yii\base\Application;

return [
    'id' => 'auth-token-query-param',
    'class' => 'digitalAscetic\humhub\modules\authtokenqueryparam\Module',
    'namespace' => 'digitalAscetic\humhub\modules\authtokenqueryparam',
    'events' => [
        [
            'class' => Application::class,
            'event' => Application::EVENT_BEFORE_REQUEST,
            'callback' => [Events::class, 'onBeforeRequest']
        ],
    ],
];
