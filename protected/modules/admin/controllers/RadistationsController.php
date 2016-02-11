<?php

class RadistationsController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
			'model'=>$this->loadModel($id),'statistic'=>$this->statistic($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Radistations;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Radistations']))
		{
			$model->attributes=$_POST['Radistations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_radiostation));
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Radistations']))
		{
			$model->attributes=$_POST['Radistations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_radiostation));
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
		$dataProvider=new CActiveDataProvider('Radistations');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Radistations('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Radistations']))
			$model->attributes=$_GET['Radistations'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Radistations the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Radistations::model()->findByPk($id);
		$license=License::model()->find('id_radiostation=:id_radiostation',
			array('id_radiostation'=>$id));
		$model->date=$license->date;
		$model->test_count=$license->test_count;
		$user=Users::model()->find('id_radiostation=:id_radiostation and id_category=:id_category',
			array('id_radiostation'=>$id,'id_category'=>2));
		$model->login=$user->login;
		$model->password=$user->password;
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Radistations $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='radistations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	protected function statistic($id){


			$model = new Users('search');
			$model->id_education=Null;

			$model->id_radiostation =$id;


			$model->id_category=3;
			$model->status_statistic=1;
		//�����
			$statistic['all']=count($model->sereachuser());
			$model->status=1;
			$statistic['ban']=count($model->sereachuser());

//��������� ������

		$model->status=Null;

		$model->create=date(" Y-m-d",strtotime("-1 week"));
		$statistic['all_week']=count($model->sereachuser());
		if(!$statistic['all_week'])

		$model->status=1;
		$statistic['ban_week']=count($model->sereachuser());


//��������� �����

		$model->status=Null;

		$model->create=date(" Y-m-d",strtotime("-1 month"));
		$statistic['all_month']=count($model->sereachuser());
		$model->status=1;
		$statistic['ban_month']=count($model->sereachuser());

//��������� ���
		$model->status=Null;
		$model->status_statistic=1;
		$model->create=date(" Y-m-d",strtotime("-1 year"));
		$statistic['all_year']=count($model->sereachuser());
		$model->status=1;
		$statistic['ban_year']=count($model->sereachuser());




			$model->status=Null;
			$model->create=Null;
			$model->active=1;

			$statistic['count_all'] = count($model->sereachuser());

			$model->sex = 1;
			$statistic['count_all_man'] = count($model->sereachuser());
			$model->sex = 2;
			$statistic['count_all_woman'] = count($model->sereachuser());
			unset($model->sex);
			//$model->sex = Null;

			$model->after_age = 14;
			$model->age_from = 1;
			$statistic['count_0_14'] = count($model->sereachuser());



			$model->after_age = 19;
			$model->age_from = 15;
			$statistic['count_15_19'] = count($model->sereachuser());


			$model->after_age = 24;
			$model->age_from = 20;
			$statistic['count_20_24'] = count($model->sereachuser());


			$model->after_age = 29;
			$model->age_from = 25;
			$statistic['count_25_29'] = count($model->sereachuser());

			$model->sex = Null;

			$model->after_age = 34;
			$model->age_from = 30;
			$statistic['count_30_34'] = count($model->sereachuser());




			$model->after_age = 39;
			$model->age_from = 35;
			$statistic['count_35_39'] = count($model->sereachuser());



			$model->after_age = 44;
			$model->age_from = 40;
			$statistic['count_40_44'] = count($model->sereachuser());



			$model->after_age = 49;
			$model->age_from = 45;
			$statistic['count_45_49'] = count($model->sereachuser());


			$model->after_age = 100;
			$model->age_from = 50;
			$statistic['count_50'] = count($model->sereachuser());
			$model->after_age = Null;
			$model->age_from = Null;
			$statistic['educations'] = EducationMult::all();

			$educations = array_keys($statistic['educations']);

			foreach ($educations as $education) {
				$model->id_education = $education;
				$statistic['education'][$education] = count($model->sereachuser());
			}


			$model->education = Null;
			$statistic['radiostations'] = RadiostationSettings::getradiostation($id);

			$radiostations = array_keys($statistic['radiostations']);

			foreach ($radiostations as $radiostation) {
				$model->P1 = $radiostation;
				$statistic['P1'][$radiostation] = count($model->sereachuser());
			}

			$model->P1 = Null;
			foreach ($radiostations as $radiostation) {
				$model->P2 = $radiostation;
				$statistic['P2'][$radiostation] = count($model->sereachuser());
			}

			$model->P2 = Null;
			$statistic['regions'] = TestSettings::getregion($id);

			$regions = array_keys($statistic['regions']);

			foreach ($regions as $region) {
				$model->region = $region;
				$statistic['region'][$region] = count($model->sereachuser());
			}

		return $statistic;
		}


}
