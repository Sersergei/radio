<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
		if ($user->radio->license->date)
			$license= Yii::t('radio','license is valid until:').$user->radio->license->date;
		if($user->radio->license->test_count){

			$license=Yii::t('radio','We can open (AMT/Call-out):').($user->radio->license->test_count-count($user->radio->MusicTest));
		}
		if($user->radio->status){
			$license=Yii::t('radio','Your licence finished. If you wanna use radiomusictest.com, call +372 59087099');
		}
		$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
		$href=Yii::t('radio','Link for registration on call-out:').Yii::app()->getBaseUrl(true)."/register/".$user->id_radiostation."?lang=".$user->radio->lang->lang;
		$AMT_href=Yii::t('radio','Link for registration on AMT:').Yii::app()->getBaseUrl(true)."/amt/index/id/".$user->id_radiostation."?lang=".$user->radio->lang->lang;

		$criteria = new CDbCriteria;
		$criteria->compare('id_radiostation', $user->id_radiostation);
		$criteria->compare('id_status',2);
		$criteria->compare('id_type',1);
		$musictest=MusicTest::model()->find($criteria);
		if($musictest) {
			$id = $musictest->id_test;

			$model = new Usertest('search');
			$model->id_music = $id;
			$statistic['count_all'] = count($model->user());

			$model->sex = 1;
			$statistic['count_all_man'] = count($model->user());
			$model->sex = 2;
			$statistic['count_all_woman'] = count($model->user());

			$model->sex = Null;
			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 14;
			$model->age_from = 1;
			$statistic['count_0_14'] = count($model->user());


			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 19;
			$model->age_from = 15;
			$statistic['count_15_19'] = count($model->user());

			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 24;
			$model->age_from = 20;
			$statistic['count_20_24'] = count($model->user());

			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 29;
			$model->age_from = 25;
			$statistic['count_25_29'] = count($model->user());

			$model->sex = Null;
			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 34;
			$model->age_from = 30;
			$statistic['count_30_34'] = count($model->user());


			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 39;
			$model->age_from = 35;
			$statistic['count_35_39'] = count($model->user());

			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 44;
			$model->age_from = 40;
			$statistic['count_40_44'] = count($model->user());


			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 49;
			$model->age_from = 45;
			$statistic['count_45_49'] = count($model->user());

			$model->unsetAttributes();
			$model->id_music = $id;
			$model->after_age = 100;
			$model->age_from = 50;
			$statistic['count_50'] = count($model->user());
			$model->after_age = Null;
			$model->age_from = Null;
			$statistic['educations'] = EducationMult::all();
			$educations = array_keys($statistic['educations']);
			foreach ($educations as $education) {
				$model->education = $education;
				$statistic['education'][$education] = count($model->user());
			}


			$model->education = Null;
			$statistic['radiostations'] = RadiostationSettings::getradiostation($model->test->id_radiostation);
			$radiostations = array_keys($statistic['radiostations']);
			foreach ($radiostations as $radiostation) {
				$model->P1 = $radiostation;
				$statistic['P1'][$radiostation] = count($model->user());
			}

			$model->P1 = Null;
			foreach ($radiostations as $radiostation) {
				$model->P2 = $radiostation;
				$statistic['P2'][$radiostation] = count($model->user());
			}

			$model->P2 = Null;
			$statistic['regions'] = TestSettings::getregion($model->test->id_radiostation);
			$regions = array_keys($statistic['regions']);

			foreach ($regions as $region) {
				$model->region = $region;
				$statistic['region'][$region] = count($model->user());
			}
			$criteria = new CDbCriteria;
			$criteria->compare('id_radiostation', $user->id_radiostation);
			$criteria->compare('id_category',3);
			$criteria->addCondition('P1 IS NOT NULL');
			$criteria->addCondition('status IS NULL');
			$criteria->addCondition('link IS NOT NULL');
			$statistic['count_invention']=count(Users::model()->findall($criteria));

		}
		else{

			$statistic=Null;
		}
		//$this->render('statistic', array('model' => $statistic));

		$this->render('index',array('license'=>$license,'href'=>$href,'AMT'=>$AMT_href,'model' => $statistic,'test'=>$musictest));
	}
}
?>