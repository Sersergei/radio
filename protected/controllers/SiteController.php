<?php

class SiteController extends Controller
{
	public $layout='//layouts/site';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		/*
		$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
	
		if(!$user){
			$this->redirect('/login');
		}
		if($user->id_category==1){
			$this->redirect('/admin');
		}
		elseif($user->id_category==2){
			$this->redirect('/radio');
		}
*/
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	public function actiomMesage(){
		$this->render('message');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{

		$this->render('contact',array());
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid
			$identity=new UserIdentity($model->username,$model->password);

			if($identity->authenticate()) {
				Yii::app()->user->login($identity);

				if(Yii::app()->user->returnUrl==DIRECTORY_SEPARATOR)
					$this->redirect('radio');
				else
				$this->redirect(Yii::app()->user->returnUrl);
			}

			else
				Yii::app()->user->setFlash('error',Yii::t('radio','Неправильное имя пользователя или пароль'));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
		else{

			$this->render('index',array());
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionAbout(){
		$this->render('about',array());
	}
	public function actionPrice(){
		$this->render('price',array());
	}
	public function actionHow(){
		$this->render('how',array());
	}
}