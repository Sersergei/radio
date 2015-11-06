<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'',
    'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
       // 'application.modules.user.models.*',
      //  'application.modules.user.components.*',
        'application.modules.admin.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'admin',
      
        //'user',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        //'shop' => array( 'debug' => 'true'),
      
	),
		),
*/

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
				//'<language:>' => 'site/index',
				'<action:(contact|login|logout|Run)>' => 'site/<action>',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		
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
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'sersergei@bigmir.net',
	),
);
