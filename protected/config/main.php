<?php
return array(
	'basePath' => 'F:\OpenServer\domains\radio.com\protected\config\..',
	'name' => 'My Web Application ',
	'preload' => array(
		'0' => 'log',
	),
	'import' => array(
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
		'user' => array(
			'allowAutoLogin' => '1',
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'class' => 'UrlManager',
			'showScriptName' => '',
			'urlSuffix' => '',
			'rules' => array(
				'<language:>' => 'site/index',
				'<language:>/<action:(contact|login|logout|Run)>' => 'site/<action>',
				'<language:\w>/<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<language:\w>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<language:\w>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		//'db' => array(
			//'connectionString' => 'sqlite:F:\OpenServer\domains\radio.com\protected\config/../data/testdrive.db',
		//),
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
