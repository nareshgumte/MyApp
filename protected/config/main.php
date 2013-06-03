<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'IntroPost',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'intropost',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        //'showScriptName' => false,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                //'' => 'site/login',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        /* 'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=intra_poc',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'padnet',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        "pageSize" => 20,
        'adminEmail' => 'naresh@purpletalk.com',
        'linkedInBaseUrl' => 'http://localhost/RenameIt/site/LinkedLogin',
        'linkedInAccess' => 'jlvxnzxefq1i',
        'linkedInSecret' => '16nUdtAzljV3xAoi',
        'linkedInCallbackUrl' => 'http://localhost/RenameIt/site/Contact',
        'scope' => 'r_basicprofile r_fullprofile r_emailaddress rw_nus r_network r_contactinfo w_messages rw_groups',
        'fb_api_key' => '327963737297629',
        'fb_api_key_secret' => 'f8a694c90e7df3b55c6e6a4e1734e3a8',
        'fb_access_token' => "BAABnZC9SmhE4BADO9FpiZCmsztm5LR6pv3RUDOR9DMWBiU4o14vBhN99y0Ah5ihv3AMSm51otWW0AXa8olBlLqHhoI81VZCmpUa7AZAplyRA9K83bWuZAYdO0Q20ZBuCRBh2bKDkkBAQZDZD",
        'defaultText' => "Welcome to Intropost!..New network to introduce your friends to each other have a great time in our new network!,hope you will njoy alot.Please Click link below   ",
        'defaultSubject' => "Invitation From Intropost",
        'defaultLink' => "http://" . $_SERVER['HTTP_HOST'] . "/" . Yii::app()->request->baseUrl,
        'access' => array
            (
            "oauth_token" => "8d41c98a-ed8f-4778-b407-b12f1a91663b",
            "oauth_token_secret" => "0bd36088-0731-4500-baab-298392be1066",
            "oauth_expires_in" => "5183996",
            "oauth_authorization_expires_in" => "5183996"
        ),
    ),
);
//https://graph.facebook.com/gumte.naresh/friends?accesstoken=BAABnZC9SmhE4BADO9FpiZCmsztm5LR6pv3RUDOR9DMWBiU4o14vBhN99y0Ah5ihv3AMSm51otWW0AXa8olBlLqHhoI81VZCmpUa7AZAplyRA9K83bWuZAYdO0Q20ZBuCRBh2bKDkkBAQZDZD
