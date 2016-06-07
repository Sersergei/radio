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

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','Bedmixmarker','Loadmixmarker','Godmixmarker','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
	public function actionIndex()
	{
		$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
		$model=RadiostationSettings::model()->find('id_radiostation=:id', array(':id'=>$user->id_radiostation));
		if($model) {
			$testsettings=TestSettings::model()->find('id_radiostation=:id', array(':id'=>$user->id_radiostation));
			$testsettingsmult=TestSettingsMult::model()->find('id_radiostations=:id', array(':id'=>$user->id_radiostation));
			$this->render('view', array(
				'model' => $model,'testsetings'=>$testsettings,'testsetingsmult'=>$testsettingsmult
			));
		}
		else $this->redirect(array('create'));
	}
	public function actionCheck(){

		$session=new CHttpSession;
		$session->open();
		$settings=new RadiostationSettings();
		$register=unserialize($session['register']);
		$settings->id_card_registration=$register->id_card_registration;
		$settings->id_lang=$register->id_lang;
		$settings->mix_marker=$session['my_mixmarker'];;
		$settings->other_radiostations=$register->other_radiostations;
		$settings->not_use_music_marker=$register->not_use_music_marker;
		$settings->not_invite_users=$register->not_invite_users;
		$settings->not_register_users=$register->not_register_users;
		$settings->email=$register->email;
		$settings->bed_mixmarker=$session['bed_mixmarker'];
		$settings->god_mixmarker=$session['god_mixmarker'];
		if(isset($_POST['yt2'])){
			if($settings->save()){
				unset($session['my_mixmarker']);
				unset($session['bed_mixmarker']);
				unset($session['god_mixmarker']);
				$this->redirect(array('TestSettings/create'));
			}
		}

		$this->render('check',array('model'=>$settings));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RadiostationSetingsRegister;
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
					$this->redirect(array('mymixmarker'));
				}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionBedmixmarker()
{
	$session=new CHttpSession;
	$session->open();

		$i=(5-count(unserialize($session['god_mixmarker'])));

	$model=new RadiostationSetingsBedmixmarker($i);
	$model->mixmarker=unserialize($session['bed_mixmarker']);
	unset ($session['bed_mixmarker']);

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if(isset($_POST['RadiostationSetingsBedmixmarker']))
	{

		$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];
		//$files=CUploadedFile::getInstances($model,'file');
		//$model->file=$files;
		$model->setScenario ('beforegod');
		if ($model->validate()){
			/*$dir=$dir=Yii::getPathOfAlias('webroot.mixmarker');
			if($files)
			foreach($files as $file){
				$mix=new Mixmarker();
				$name=time().str_replace(" ","",$file->getName());
				$mix->name=$name;
				$mix->save();
				$model->mixmarker[]=$mix->id;
				$file->saveAs($dir.'/'.$name);
			}
			*/
			$model->setScenario ('after');
			if($model->validate()){

				//$bedmixmarker=array_merge($mix,$model->mixmarker);
				$session['bed_mixmarker']=serialize($model->mixmarker);
				$this->redirect(array('check'));
			}

		}
	}

	$this->render('bedmixmarker',array(
		'model'=>$model,'i'=>$i,
	));
}





	public function actionMymixmarker()
	{
		$session=new CHttpSession;
		$session->open();
		$model=new RadiostationSetingsBedmixmarker(1);
		unset($session['my_mixmarker']);

		if(isset($_POST['RadiostationSetingsBedmixmarker']))
		{

			$settings=unserialize($session['register']);


			$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];
			$files=CUploadedFile::getInstances($model,'file');
			$model->file=$files;
			$model->setScenario ('before');
			if ($model->validate()){
				$dir=$dir=Yii::getPathOfAlias('webroot.mixmarker');
				if($files){
					foreach($files as $file){
						$mix=new Mixmarker();
						$name=time().str_replace(" ","",$file->getName());
						$mix->name=$name;
						$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
						$mix->id_radiostation=$user->id_radiostation;
						$mix->save();
						$model->mixmarker=$mix->id;
						$file->saveAs($dir.'/'.$name);
					}
					$session['my_mixmarker']=$mix->id;
					//$session['my_mixmarker']=$model->mixmarker[0];

				}
				$this->redirect(array('godmixmarker'));
				}
			}


		$this->render('mymixmarker',array(
			'model'=>$model,
		));
	}

	public function actionGodmixmarker()
	{



		$session=new CHttpSession;
		$session->open();
		if($session['my_mixmarker']){
			$i=3;

		}
		else{

			$i=4;
		}
		$model=new RadiostationSetingsBedmixmarker($i);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
$model->mixmarker=unserialize($session['god_mixmarker']);
		if(isset($_POST['RadiostationSetingsBedmixmarker']))
		{
			$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];
			//$files=CUploadedFile::getInstances($model,'file');
			//$model->file=$files;
			if($session['my_mixmarker']){
				$model->setScenario ('beforegod');
			}
			else{

				$model->setScenario ('aftergood');
			}

			/*
			if ($model->validate()){
				$dir=$dir=Yii::getPathOfAlias('webroot.mixmarker');
				if($files)
					foreach($files as $file){
						$mix=new Mixmarker();
						$name=time().str_replace(" ","",$file->getName());
						$mix->name=$name;
						$mix->save();
						$model->mixmarker[]=$mix->id;
						$file->saveAs($dir.'/'.$name);
					}
			*/
			if ($model->validate()){
				$session['god_mixmarker']=serialize($model->mixmarker);
				$this->redirect(array('bedmixmarker'));
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
				$this->redirect(array('/radio/radiostationSettings'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionUpdatebedmixmarker($id){
		$radiosettings=$this->loadModel($id);
		$mix=unserialize($radiosettings->bed_mixmarker);
		$model=new RadiostationSetingsBedmixmarker(4);
		$model->mixmarker=$mix;
		if(isset($_POST['RadiostationSetingsBedmixmarker'])){

			$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];
			$files=CUploadedFile::getInstances($model,'file');
			$model->file=$files;
			$model->setScenario ('before');
			if ($model->validate()){
				$dir=$dir=Yii::getPathOfAlias('webroot.mixmarker');
				if($files)
					foreach($files as $file){
						$mix=new Mixmarker();
						$name=time().str_replace(" ","",$file->getName());
						$mix->name=$name;
						$mix->save();
						$model->mixmarker[]=$mix->id;
						$file->saveAs($dir.'/'.$name);
					}
				$model->setScenario ('after');
				if($model->validate()){

					$radiosettings->bed_mixmarker=serialize($model->mixmarker);
					$radiosettings->save();
					$this->redirect(array('/radio/radiostationSettings'));
				}

			}

		}
		$this->render('updatebedmix',array(
			'model'=>$model,
		));
	}
	public function actionUpdategodmixmarker($id){
		$radiosettings=$this->loadModel($id);
		$mix=unserialize($radiosettings->god_mixmarker);
		$model=new RadiostationSetingsBedmixmarker(2);
		$model->mixmarker=$mix;
		$model->id=$id;
		if(isset($_POST['RadiostationSetingsBedmixmarker'])){

			$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];
			$files=CUploadedFile::getInstances($model,'file');
			$model->file=$files;
			$model->setScenario ('beforegod');
			if ($model->validate()){
				$dir=$dir=Yii::getPathOfAlias('webroot.mixmarker');
				if($files)
					foreach($files as $file){
						$mix=new Mixmarker();
						$name=time().str_replace(" ","",$file->getName());
						$mix->name=$name;
						$mix->save();
						$model->mixmarker[]=$mix->id;
						$file->saveAs($dir.'/'.$name);
					}
				$model->setScenario ('after');
				if($model->validate()){

					$radiosettings->god_mixmarker=serialize($model->mixmarker);
					$radiosettings->save();
					$this->redirect(array('/radio/radiostationSettings'));
				}

			}

		}
		$this->render('updatebedmix',array(
			'model'=>$model,
		));
	}
	public function actionUpdatemixmarker($id){
		$radiosettings=$this->loadModel($id);
		$session=new CHttpSession;
		$session->open();
		$model=new RadiostationSetingsBedmixmarker(1);
		unset($session['my_mixmarker']);

		if(isset($_POST['RadiostationSetingsBedmixmarker']))
		{

			$settings=unserialize($session['register']);


			$model->attributes=$_POST['RadiostationSetingsBedmixmarker'];
			$files=CUploadedFile::getInstances($model,'file');
			$model->file=$files;
			$model->setScenario ('before');
			if ($model->validate()){
				$dir=$dir=Yii::getPathOfAlias('webroot.mixmarker');
				if($files){
					foreach($files as $file){
						$mix=new Mixmarker();
						$name=time().str_replace(" ","",$file->getName());
						$mix->name=$name;
						$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
						$mix->id_radiostation=$user->id_radiostation;
						$mix->save();
						$model->mixmarker=$mix->id;
						$file->saveAs($dir.'/'.$name);
					}
					$session['my_mixmarker']=$mix->id;
					//$session['my_mixmarker']=$model->mixmarker[0];

				}
				$radiosettings->mix_marker=$mix->id;
				$radiosettings->save();
				$this->redirect(array('/radio/radiostationSettings'));
			}
		}


		$this->render('mymixmarker',array(
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

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RadiostationSettings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


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
		$user=Users::model()->findByPk(Yii::app()->user->id);

		$model=RadiostationSettings::model()->findByPk($id);
		if($user->id_radiostation!==$model->id_radiostation)
			throw new CHttpException(403,'Недостаточно прав');
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
