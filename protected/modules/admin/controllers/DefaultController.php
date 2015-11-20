<?php

class DefaultController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			// we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		$user=Users::model()->findByPk(26);
		$r=new UsersInvitation($user);
		$this->render('index');
	}
}