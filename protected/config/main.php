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
        'ext.booster.helpers.*',
        'ext.egmap.*',
        'application.vendors.linkify.*'
    ),

    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>false,
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        'hybridauth' => array(
            'baseUrl' => 'http://'. $_SERVER['SERVER_NAME'] . '/hybridauth',
            "providers" => array (
                "facebook" => array (
                    "enabled" => true,
                    "keys"    => array ( "id" => "1431198330481769", "secret" => "97fecea5d93e5de0b727c6b6c48e5994" ),
                    "scope"   => "email, publish_stream, user_birthday, publish_actions, user_about_me",
                    "display" => ""
                ),
                "Google" => array (
                    "enabled" => true,
                    "keys"    => array ( "id" => "1025304017473-i6cks1ccp2jf7jka97v6mv52fp1j5lfr.apps.googleusercontent.com", "secret" => "ZttmSTERTxbxCC2BgcM1-vzf" ),
                    "scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                        "https://www.googleapis.com/auth/userinfo.email"   , // optional
                    "access_type"     => "offline",   // optional
                    "approval_prompt" => "force",     // optional
                )
            )
        )
    ),

    // application components
    'components'=>array(
        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'booster'=>array(
            'class'=>'ext.booster.components.Booster'
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
        'cache'=>array(
            'class'=>'system.caching.CMemCache',
            'useMemcached'=>true
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

    'params'=>array(
        'adminEmail'=>'webmaster@example.com',
        'eventLat'=>47.025528242874,
        'eventLng'=>28.8305027851974,
    ),
);