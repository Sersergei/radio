<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
		if ($user->radio->license->date)
			$license= Yii::t('radio','Лицензия действительна до:').$user->radio->license->date;
		if($user->radio->license->test_count){

			$license=Yii::t('radio','Остаток тестов по лицензии:').($user->radio->license->test_count-count($user->radio->MusicTest));
		}
		if($user->radio->status){
			$license=Yii::t('radio','У вас закончилась лицензия обратитесь к администратору ресурса');
		}
		$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
		$href=Yii::t('radio','Ссылка на приглашение слушателей пройти регистрацию:').Yii::app()->getBaseUrl(true)."/register/".$user->id_radiostation."?lang=".$user->radio->lang->lang;
		$AMT_href=Yii::t('radio','Ссылка на приглашение слушателей пройти AMT тест:').Yii::app()->getBaseUrl(true)."/amt/index/id/".$user->id_radiostation."?lang=".$user->radio->lang->lang;
		$this->render('index',array('license'=>$license,'href'=>$href,'AMT'=>$AMT_href));
	}
}
?>