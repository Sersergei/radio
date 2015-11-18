<?php

class TestController extends Controller
{
	public function actionIndex($id=NULL,$linc=NULL)
	{

		$criteria=new CDbCriteria();
		$criteria->condition = 'id_user = :id AND link = :link';
		$criteria->params = array(':id'=>$_GET['id'], ':link'=>$_GET['linc']);
		$model=Users::model()->find($criteria);
		$r=$model->radio->settings->text_before_test;
		//$model->findAll($criteria);

		if($model){
			$cookie = new CHttpCookie('user', serialize($model));//устанавливаем куки юзера на 30 мин
			$cookie->expire = time() + 1800;
			Yii::app()->request->cookies['user']=$cookie;
			$this->render('index',array('model'=>$r,'message'=>'','buton'=>'Songstest'));
		}
		else{
			throw new CHttpException(403,  'Такого теста не существует');

		}

	}
	public function actionSongstest(){

	if($user=Yii::app()->request->cookies['user']){{
		$model=unserialize($user->value);
		$r=$model->radio->radiostationSettings->test_song;
		$sound=Yii::t('radio', 'Песня для тестирования не найдена');
		$criteria=new CDbCriteria();
		$criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
		$criteria->params = array(':id_radiostation'=>$model->id_radiostations, ':id_status'=>2);
		$test=MusicTest::model()->find($criteria);

		if($mix=Mixmarker::model()->findbyPk($r))
			$sound='<audio src=../../mixmarker/'. $mix->name . ' controls></audio>';
		$this->render('index',array('model'=>$sound,'message'=>Yii::t('radio', 'Songs'),'buton'=>'Songs'));
	}}

}
	public function actionSongs(){
		;
		if($user=Yii::app()->request->cookies['user']){{
			$model=unserialize($user->value);
			$r=$model->radio->radiostationSettings->test_song;
			$sound=Yii::t('radio', 'Песня для тестирования не найдена');
			if($mix=Mixmarker::model()->findbyPk($r))
				$sound='<audio src=../../mixmarker/'. $mix->name . ' controls></audio>';
			$this->render('index',array('model'=>$sound,'message'=>Yii::t('radio', 'Songs'),'buton'=>'Songs'));
		}}

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}