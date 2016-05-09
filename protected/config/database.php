<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database

	'connectionString' => 'mysql:host=db.colocall.net;dbname=radio1',
	'emulatePrepare' => true,
	'username' => 'radio1',
	'password' => 'BP057982',
	'charset' => 'utf8',
	'enableProfiling' => true,
	'enableParamLogging' => true,
);