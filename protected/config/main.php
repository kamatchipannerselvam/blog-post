<?php
$params = require(__DIR__ . '/params.php');
$config = [
	'id' => 'SimpleBlogPost',
	'name' => 'Simple Blog Post',
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'runtimePath' => dirname(__FILE__) . '/../runtime',
	'preload'=>array('log','Aliases'),
	'import' => array(
		'application.components.*',
		'application.controllers.*',
		'application.models.*',
	),
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'live-posts' => 'site/livePosts',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? 3 : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					'logFile' => 'application.log',
				),
			),
		),
		'request' => array(
            'enableCookieValidation' => true, // Prevent tampering
            'enableCsrfValidation' => true,  // Enable CSRF protection
        ),
		'session' => array(
            'class' => 'CHttpSession',
            'autoStart' => true,  // Start session automatically
            'timeout' => 3600,  // Session timeout in seconds (1 hour)
            'cookieParams' => array(
                'httponly' => true, 
                'secure' => false,  // Change to `true` if using HTTPS
            ),
        ),
		'cache' => array(
            'class' => 'CFileCache',  // Use file-based caching
        ),
		'authManager' => array(
            'class' => 'CDbAuthManager', // Use CPhpAuthManager if you prefer file-based RBAC
            'connectionID' => 'db',  // Ensure it matches the database connection
            'itemTable' => 'authitem',
            'assignmentTable' => 'authassignment',
            'itemChildTable' => 'authitemchild',
        ),
	),
	'modules'=>array(
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),
];
return $config;
