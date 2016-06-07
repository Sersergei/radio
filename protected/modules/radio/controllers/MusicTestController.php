<?php

class MusicTestController extends Controller
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
				'actions'=>array('index','view','create','update','upload','delete','deletesongs'),
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

		$songs=new Songs();
		$songs->id_test=$id;
		$this->render('view',array(
			'model'=>$this->loadModel($id),'songs'=>$songs,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$user=Users::model()->findByPk(Yii::app()->user->id);


		$criteria=new CDbCriteria;
		$criteria->compare('id_radiostation',$user->id_radiostation);
		$criteria->compare('id_type',1);
		$criteria->order = 'date_add DESC';
		$last_colaut=MusicTest::model()->find($criteria);


		$criteria=new CDbCriteria;
		$criteria->compare('id_radiostation',$user->id_radiostation);
		$criteria->compare('id_type',2);
		$criteria->order = 'date_add DESC';
		$last_amt=MusicTest::model()->find($criteria);


		$model=new MusicTest;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        //var_dump($_POST);
		if(isset($_POST['MusicTest']))
		{


			$model->attributes=$_POST['MusicTest'];
			$model->id_radiostation=$user->id_radiostation;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_test));
		}

		$this->render('create',array(
			'model'=>$model,'colaut'=>$last_colaut,'amt'=>$last_amt,
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
		$songs=new Songs();
		$songs->id_test=$id;
		if(isset($_GET['Songs']))
		$songs->attributes=$_GET['Songs'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['MusicTest']))
		{
			$songs->attributes=$_POST['MusicTest'];
			$model->attributes=$_POST['MusicTest'];
			if($model->save()){
				$old=Yii::getPathOfAlias('webroot.upload').DIRECTORY_SEPARATOR.Yii::app()->user->id;
				$new=Yii::getPathOfAlias('webroot.musictest').DIRECTORY_SEPARATOR.$id;


				$files=CFileHelper::findFiles($old, ['fileTypes' => ['mp3',''], 'level' => 1]);

				$iduser=Yii::app()->user->id;
				if($files) {
					if(!file_exists ($new) )
						mkdir($new);
					foreach ($files as $file) {
						$old = Yii::getPathOfAlias('webroot.upload') . DIRECTORY_SEPARATOR . Yii::app()->user->id;
						$new = Yii::getPathOfAlias('webroot.musictest') . DIRECTORY_SEPARATOR . $id;
						$songs = new Songs();
						$songs->id_test = $id;
						//$info = $this->mp3info($file);
						$name = stristr($file, Yii::app()->user->id);
						$name = stristr($name, '.mp3', true);
						$usersep = $iduser . DIRECTORY_SEPARATOR;
						$name = str_replace("{$usersep}", "", $name);
						$old = $old . DIRECTORY_SEPARATOR . $name . '.mp3';
						$new = $new . DIRECTORY_SEPARATOR . $name . '.mp3';
						rename($old, $new);
						$songs->name = $name;
						$songs->song_file = $new;
						$songs->validate();
						$songs->save();
					}
				}
				$this->redirect(array('view','id'=>$model->id_test));
			}

		}

		$this->render('update',array(
			'model'=>$model,'songs'=>$songs,
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
	public function actiondeletesongs($id){
		$model=Songs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		$model->delete();
		if(!isset($_GET['ajax']))

			$this->redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 * Lists all models.

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('MusicTest');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	 * Manages all models.
	 */
	public function actionIndex()
	{
		$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
		$model=new MusicTest('search');
		$model->unsetAttributes();  // clear any default values
		$model->id_radiostation=$user->id_radiostation;
		$test=MusicTest::model()->find();
		if(isset($_GET['MusicTest']))
			$model->attributes=$_GET['MusicTest'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MusicTest the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$user=Users::model()->findByPk(Yii::app()->user->id);
		$test= MusicTest::model()->findByPk($id);
		if($user->id_radiostation!==$test->id_radiostation)
			throw new CHttpException(403,'Недостаточно прав');
		$model=MusicTest::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MusicTest $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='music-test-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionUpload()
	{

		Yii::import("ext.EAjaxUpload.qqFileUploader");
		$dir=Yii::getPathOfAlias('webroot.upload').'/'.Yii::app()->user->id.'/';
if(!file_exists ($dir) )
	mkdir($dir);


		$folder=$dir;// folder for uploaded files
		$allowedExtensions = array("mp3");//array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 100 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

		//$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
		//$fileName=$result['filename'];//GETTING FILE NAME
		//$img = CUploadedFile::getInstance($model,'image');

		echo $return;// it's array
	}
}
