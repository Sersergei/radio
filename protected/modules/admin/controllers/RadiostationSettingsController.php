<?php

class RadiostationSettingsController extends Controller
{
	public $register;
	public $bed_mixmarker;
	public $good_mixmarker;
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
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Bedmixmarker','Loadmixmarker'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RadiostationSetingsRegister;
//var_dump($_POST);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RadiostationSetingsRegister']))
		{
			//var_dump($_POST['RadiostationSettings']);
			$model->attributes=$_POST['RadiostationSetingsRegister'];

				if ($model->validate()){
					$this->register=$model;
					$this->redirect(array('bedmixmarker'));
				}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionBedmixmarker()
{

	$model=new RadiostationSetingsBedmixmarker;

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if(isset($_POST['RadiostationSetingsBedmixmarker']))
	{
		//var_dump($_POST['RadiostationSettings']);
		$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];

		if ($model->validate()){
			$this->bed_mixmarker=$model;
			if(count($model->mixmarker)<4){
				$i=4-count($model->mixmarker);
				$this->redirect(array('loadmixmarker','id'=>$i));
			}
			$this->redirect(array('godmixmarker'));
		}
	}

	$this->render('bedmixmarker',array(
		'model'=>$model,
	));
}
	public function actionLoadmixmarker()
	{

		$model=new loadmix();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RadiostationSetingsBedmixmarker']))
		{
			//var_dump($_POST['RadiostationSettings']);
			$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];
			$model->image=CUploadedFile::getInstance($model,'file');
			if($model->save()){
				$path=Yii::getPathOfAlias('webroot.mixmarker').'/'.$model->file->getName();
				$model->image->saveAs($path);
			}

		}

		$this->render('loadmixmarker',array(
			'model'=>$model,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RadiostationSettings']))
		{
			$model->attributes=$_POST['RadiostationSettings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_radio_settings));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RadiostationSettings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RadiostationSettings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RadiostationSettings']))
			$model->attributes=$_GET['RadiostationSettings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RadiostationSettings the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RadiostationSettings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RadiostationSettings $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='radiostation-settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
