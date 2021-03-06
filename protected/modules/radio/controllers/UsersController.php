<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{

		return array(

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','view','index','LoadUser','statistic','Test'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),

		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=new Usertest('search');
		$model->unsetAttributes();
		$model->id_user=$id;

		$this->render('view',array(
			'model'=>$this->loadModel($id),'test'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$this->performAjaxValidation($model);
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_user));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id=Null,$link=Null)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('/test/index/id/'.$id.'/linc/'.$link));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	 * Manages all models.
	 */
	public function actionIndex()
	{
		$user=$this->loadModel(Yii::app()->user->id);
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		$model->id_radiostation=$user->id_radiostation;
		$model->id_category=3;
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$user=Users::model()->findByPk(Yii::app()->user->id);
		$model=Users::model()->findByPk($id);
		if($user->id_radiostation!==$model->id_radiostation)
			throw new CHttpException(403,'Недостаточно прав');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			if( !empty($_POST['Users']['radiostation']) !=='admin'){
				$model->setScenario ('noadmin');
			}
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionLoadUser(){
		$model=new Load;
		$i=0;
		$errorusers=Null;
		if(isset($_POST['load'])){
			$radio=Users::model()->findByPk(Yii::app()->user->id);
			//$files=CUploadedFile::getInstances($model,'file');
			$model->attributes=$_POST['load'];
			$model->document=CUploadedFile::getInstance($model,'document');
			if($model->validate()){
				$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');

				include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');


				$objPHPExcel = PHPExcel_IOFactory::load($_FILES['load']['tmp_name']['document']);
				$ar=$objPHPExcel->getActiveSheet()->toArray();

				$errorusers=Null;
				foreach($ar as $user){
					$usermodel=new Users();
					$usermodel->name_listener=$user[0];
					$usermodel->email=$user[1];

					$usermodel->id_radiostation=$radio->id_radiostation;
					$usermodel->scenario = 'load';

					if($usermodel->save()){

						$email=new EmailInvintation();
						$email->email($usermodel);
						$i++;
					}
					else{

						$errorusers[]=$usermodel;
					}
				}
			}

		}
		$this->render('load',array('model'=>$model,'coun'=>$i,'error'=>$errorusers));
	}
	public function actionStatistic(){
		$radio=Users::model()->findByPk(Yii::app()->user->id);
		$this->render('statistic',array('statistic'=>Radistations::statistic($radio->id_radiostation),));
			
	}
	public function actionTest($id,$test){
		$model=new MusicTestDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MusicTestDetail']))
			$model->attributes=$_GET['Users'];
		$model->id_user=$id;
		$model->id_test=$test;
		$this->render('testuser',array(
			'model'=>$model,
		));

	}

}
