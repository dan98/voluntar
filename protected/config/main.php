<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Web Application',
    'defaultController'=>'event',

    // preloading 'log' component
    'preload'=>array('log', 'booster', 'debug'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.vendors.*',
    ),

    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>false,
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),

    // application components
    'components'=>array(
        'booster'=>array(
            'class'=>'ext.yiibooster.components.Booster'
        ),
        'debug'=>array(
            'class'=>'ext.debug.Yii2Debug'
        ),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl' => '/',
            'returnUrl' => '/',
            'class' => 'WebUser',
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '/me'=>'/user/view',
                '/login'=>'/user/login',
                '/logout'=>'/user/logout',
                '/register'=>'/user/create'
            ),
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=voluntar',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'hypertext',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                //array(
                //    'class'=>'CWebLogRoute',
                //),
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
    ),
);