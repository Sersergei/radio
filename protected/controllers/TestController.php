<?php

class TestController extends Controller
{
	public $layout='/layouts/column2';
	public function actionIndex($id=NULL,$linc=NULL)
	{

		$criteria=new CDbCriteria();
		$criteria->condition = 'id_user = :id AND link = :link';
		$criteria->params = array(':id'=>$_GET['id'], ':link'=>$_GET['linc']);
		$model=Users::model()->find($criteria);

		//$model->findAll($criteria);

		if($model){

			$r=$model->radio->settings->text_before_test;
			$cookie = new CHttpCookie('user',$model->id_user);//устанавливаем куки юзера на 30 мин
			$cookie->expire = time() + 1800*60;
			Yii::app()->request->cookies['user']=$cookie;
			$this->render('index',array('model'=>$r,'message'=>'','buton'=>'Songstest'));
		}
		else{
			throw new CHttpException(403,  'Такого теста не существует');

		}

	}
	public function actionSongstest(){
		$session = new CHttpSession;
		$session->open();
//выбор песни для настройки аудио
	if($user=Yii::app()->request->cookies['user']){
		$model=$user->value;
		$model=Users::model()->findByPk($model);
		$criteria=new CDbCriteria();
		$criteria->condition = 'id_radiostation = :id_radiostation';
		$criteria->params = array(':id_radiostation'=>$model->id_radiostation);
		$radiosetings=RadiostationSettings::model()->find($criteria);

		if($radiosetings->never_test)//если не стоит галочка всеравно голосовать
		{
			$session['never_test']=1;
		}

		else
		{
			$session['never_test']=0;
		}


		if($radiosetings->mix_marker)
		$r=$radiosetings->mix_marker;//песня для тестирования музыки
		else{
			$r=unserialize($radiosetings->god_mixmarker);
			$r=$r[0];
		}
		if(!$r)
		$sound=Yii::t('radio', 'Песня для тестирования не найдена');

		$criteria=new CDbCriteria();
		$criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
		$criteria->params = array(':id_radiostation'=>$model->id_radiostation, ':id_status'=>2);
		$test=MusicTest::model()->find($criteria);
		$test=$test->songs;//список тестируемых песен


		$con=count($test); //количество тестируемых песен

		$soundtest=array_rand($test, 1); //выбираем случайную песню
		//if(!Yii::app()->request->cookies['soundtest']) {
			$session['soundtest']= $soundtest;//устанавливаем куки тестируемой песни на 30 мин

			$session['test']=serialize($test);//устанавливаем куки масива песен на 30 мин

		$dur = 0;

			$session['dur'] = $dur;
		$time=new DateTime();
		$cookie = new CHttpCookie('time',serialize($time));//устанавливаем куки юзера на 30 мин
		$cookie->expire = time() + 5800*60;
		Yii::app()->request->cookies['time']=$cookie;
			//$session['time'] = time();
			$session['con']=$con;
			$last = 0;
			$session['last'] = $last;

			$session['testresult']=array();

		//}
		if($mix=Mixmarker::model()->findbyPk($r))
			$sound="<div class='songstext'>
        <div class='lm-track lmtr-top'>
            <audio id='player_".$mix->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $mix->name." autoplay></audio>
</div>".Yii::t('radio', 'I will now play songs to you. Check now, that your speakers are turned on and the volume is not too loud. After listening to each song, I will ask you a few questions.Thank you for your time!').'</div>';

		$this->render('index',array('model'=>$sound,'message'=>Yii::t('radio', 'Songs'),'buton'=>'Songs'));
	}

}
	public function actionSongs(){
		$session = new CHttpSession;
		$session->open();
		//перебор песен теста

		if($session['test']){

			$sound=$session['soundtest'];
			$test=unserialize($session['test']);
			if(!isset($test[$sound])){
				$this->redirect('finish');
			}


			$con=$session['con'];
			$progress=100-((count($test)/$con)*100);

			$user=Yii::app()->request->cookies['user'];
			$user=$user->value;
			$user=Users::model()->findByPk($user);
			//вытаскиваем нужный тест
			$criteria=new CDbCriteria();
			$criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
			$criteria->params = array(':id_radiostation'=>$user->id_radiostation, ':id_status'=>2);
			$musictest=MusicTest::model()->find($criteria);
			$model=new MusicTestDetail();
			$model->id_test=$musictest->id_test;
			$model->id_user=$user->id_user;

			$model->id_song=$test[$sound]->id_song;
			$song=$test[$sound]->song_file;

			$song="/".stristr($song,'musictest');
			$song=str_replace('\\','/',$song);
			if(isset($_POST['yt1'])){
				$model->id_like=5;
			}
			if(isset($_POST['yt2'])){
				$model->id_like=4;
			}
			if(isset($_POST['yt3'])){
				$model->id_like=3;
			}
			if(isset($_POST['yt4'])){
				$model->id_like=2;
			}
			if(isset($_POST['yt5'])){
				$model->id_like=1;
			}
			if(isset($_POST['never'])){
				$model->never=5;
			}

			if((isset($model->id_like)) or ($model->never==5))
			{

				$session['old_sound']=$sound;// последний музікальній тест
				$session['old_test']=$session['test'];// список последних осташихся


				$model->date_last=date(" Y-m-d");

				if($model->validate()){
					unset($test[$sound]);
						if(count($test))
					$soundtest=array_rand($test, 1); //выбираем случайную песню
					else $soundtest=0;

					$session['soundtest']=$soundtest;//устанавливаем куки тестируемой песни на 30 мин


						$session['test']= serialize($test);//устанавливаем куки масива песен на 30 мин

					if($session['testresult'])
					$testresult=unserialize($session['testresult']);
					$testresult[]=$model;

				$session['testresult']=serialize($testresult);
					$this->redirect(array('/test/Songs'));
					if(!isset($model->id_like))
						$model->id_like=10;
					if($session['last']==$model->id_like ){
						$session['dur']++;
						if($session['dur']>=5){
							$session['baned']=true;
						}
					}
				}


		}

			if($session['never_test']){

				$this->render('create1',array(
					'model'=>$model,'song'=>$song,'progress'=>$progress,
				));
			}
			else{

				$this->render('create',array(
					'model'=>$model,'song'=>$song,'progress'=>$progress,
				));
			}

			}

		else{

			$this->redirect('finish');
		}


	}
	public function actionRepeat(){
		$session = new CHttpSession;
		$session->open();

$test=unserialize($session['test']);
		if($session['con']!=count($test)){
			$session['test']= $session['old_test'];//устанавливаем куки масива песен на 30 мин

		$session['soundtest']= $session['old_sound'];//устанавливаем куки масива песен на 30 мин

		$testresult=unserialize($session['testresult']);
		array_pop($testresult);
			$session['testresult']=serialize($testresult);

	}
		$this->redirect('Songs');

	}
	public function actionFinish(){

		$session = new CHttpSession;
		$session->open();
		if($session['testresult']){


			$date_last=$session['date_last'];

			$user=Yii::app()->request->cookies['user'];
			$user=$user->value;
			$user=Users::model()->findByPk($user);

			$criteria=new CDbCriteria();
			$criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
			$criteria->params = array(':id_radiostation'=>$user->id_radiostation, ':id_status'=>2);
			$test=MusicTest::model()->find($criteria);
			$usertest=new Usertest();
			$usertest->id_user=$user->id_user;
			$usertest->id_music=$test->id_test;
			$usertest->date=date(" Y-m-d");
			$session = new CHttpSession;
			$session->open();
			$time=Yii::app()->request->cookies['time'];

			$time=$time->value;
			$time1=unserialize($time);
			$time2=new DateTime();
			$interval = $time1->diff($time2);
			$usertest->time=$interval->format('%H:%I:%S');

			$usertest->save();
			$testresult=unserialize($session['testresult']);
			//print_r($testresult);
			foreach($testresult as $model){

				$model->finaly=date(" Y-m-d");
				$model->save();
			}
			$user->link='';
			$user->save();
			unset($session['testresult']);
			//Yii::app()->request->cookies->remove('like');
			//$like->remove;
			$text=$user->radio->settings->text_after_test;
			$this->render('finish',array('model'=>$text,'message'=>''));

		}
	}
}