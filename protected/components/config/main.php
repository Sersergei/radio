<?php
return array(

	'name' => 'My Web Application ',
	'preload' => array(
		'0' => 'log',
	),
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'0' => 'application.models.*',
		'1' => 'application.components.*',
	),
	'modules' => array(
		'admin',
		'user',

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
	'components' => array(
		//'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
			//'allowAutoLogin'=>true,
			//'loginUrl' => array('/user/login'),
		//),

		'urlManager' => array(
			'urlFormat' => 'path',
			'class' => 'UrlManager',
			'showScriptName' => '',
			'urlSuffix' => '',
			'rules' => array(
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',



				'<action:(contact|login|logout|Run)>' => 'site/<action>',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',


			),
		),

		//include_once(database.php);
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=radio',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				'0' => array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),

	'params' => array(
		'adminEmail' => 'webmaster@example.com',
	),
);
