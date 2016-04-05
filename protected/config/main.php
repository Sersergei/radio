<?php
Yii::setPathOfAlias('booster', dirname(__FILE__) . DIRECTORY_SEPARATOR . '../booster');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'',
    'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log,bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
       //'application.modules.admin.models.*',
      //  'application.modules.user.components.*',
        'application.modules.admin.models.*',
		'application.extensions.EAjaxUpload.*',
		'ext.eoauth.*',
		'ext.eoauth.lib.*',
		'ext.lightopenid.*',
		'ext.eauth.*',
		'ext.eauth.services.*',

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'admin',
		'radio',
      
        //'user',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        //'shop' => array( 'debug' => 'true'),
      
	),

	// application components
	'components'=>array(
		'loid' => array(
			'class' => 'ext.lightopenid.loid',
		),

		'PHPExcel'=>array(
			'class'=>'ext.phpexcel.Classes.PHPExcel'
		),
		/*'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
		),
*/

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
				//'<language:>' => 'site/index',
				'<action:(mesage|login|logout|Run)>' => 'site/<action>',

				'<controller:\w+>/<id:\d+>' => 'register',
				//'test/index/<id:\d+>/<category:\w+>' => 'test/<id>/<category>',
				//'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'Smtpmail'=>array(
			'class'=>'application.extensions.smtpmail.PHPMailer',
			'Host'=>"smtp.gmail.com",
			'Username'=>'radiomusictestcom@gmail.com',
			'Password'=>'ch057982859',
			'Mailer'=>'smtp',
			'Port'=>587,
			'SMTPAuth'=>true,
			'SMTPSecure' => 'tls',
		),
		

		// database settings are configured in database.php
		//'db'=>require(dirname(__FILE__).'/database.php'),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=radio',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
			'enableProfiling' => true,
			'enableParamLogging' => true,
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
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
