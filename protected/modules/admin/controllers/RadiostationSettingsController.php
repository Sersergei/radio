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

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','view','create','Bedmixmarker','Loadmixmarker','Godmixmarker','update','index'),
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

			$model->attributes=$_POST['RadiostationSetingsRegister'];

				if ($model->validate()){
					$session=new CHttpSession;
					$session->open();
					$session['register']=serialize($model);
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

	$model=new RadiostationSetingsBedmixmarker(4);

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if(isset($_POST['RadiostationSetingsBedmixmarker']))
	{
		//var_dump($_POST['RadiostationSettings']);
		$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];

		if ($model->validate()){
			$session=new CHttpSession;
			$session->open();
			$session['bed_mixmarker']=serialize($model->mixmarker);
			if(count($model->mixmarker)<4){
				$i=4-count($model->mixmarker);
				$this->redirect(array('loadmixmarker','id'=>$i,'status'=>'bed'));
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

		$model=new loadmix($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$dir=$dir=Yii::getPathOfAlias('webroot.mixmarker');
		if(isset($_POST['loadmix']))
		{
			$model->attributes=$_POST['loadmix'];
			$files=CUploadedFile::getInstances($model,'file');
			$model->file=$files;
			if($model->validate()){
				foreach($files as $file){
					$mix=new Mixmarker();
					$name=time().str_replace(" ","",$file->getName());
					$mix->name=$name;
					$mix->save();
					$marker[]=$mix->id;
					$file->saveAs($dir.'/'.$name);
				}
				if($_GET['status']=='bed'){
					$session=new CHttpSession;
					$session->open();
					$mix=unserialize($session['bed_mixmarker']);
					$session['bed_mixmarker']=serialize(array_merge($mix,$marker));
					$this->redirect(array('godmixmarker')
					);
				}
				if($_GET['status']=='god'){
					$session=new CHttpSession;
					$session->open();
					$mix=unserialize($session['god_mixmarker']);
					$session['god_mixmarker']=serialize(array_merge($mix,$marker));
					$this->redirect(array('mixmarker')
					);
				}
				if($_GET['status']=='my'){
					$session=new CHttpSession;
					$session->open();
					$settings=new RadiostationSettings();
					$register=unserialize($session['register']);
					$settings->id_card_registration=$register->id_card_registration;
					$settings->id_lang=$register->id_lang;
					$settings->mix_marker=$marker[0];
					$settings->other_radiostations=$register->other_radiostations;
					$settings->not_use_music_marker=$register->not_use_music_marker;
					$settings->not_invite_users=$register->not_invite_users;
					$settings->not_register_users=$register->not_register_users;
					$settings->bed_mixmarker=$session['bed_mixmarker'];
					$settings->god_mixmarker=$session['god_mixmarker'];
					if($settings->save())

					$this->redirect(array('TestSettings/create')
					);
				}

			}
		}


		$this->render('loadmixmarker',array(
			'model'=>$model,
		));
	}
	public function actionGodmixmarker()
	{

		$model=new RadiostationSetingsBedmixmarker(2);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RadiostationSetingsBedmixmarker']))
		{
			$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];

			if ($model->validate()){
				$session=new CHttpSession;
				$session->open();
				$session['god_mixmarker']=serialize($model->mixmarker);
				if(count($model->mixmarker)<2){
					$i=2-count($model->mixmarker);
					$this->redirect(array('loadmixmarker','id'=>$i,'status'=>'god'));
				}
				$this->redirect(array('loadmixmarker','id'=>1,'status'=>'my'));
			}
		}

		$this->render('godmixmarker',array(
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
