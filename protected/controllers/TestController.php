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
//выбор песни для настройки аудио
	if($user=Yii::app()->request->cookies['user']){
		$model=$user->value;
		$model=Users::model()->findByPk($model);
		$criteria=new CDbCriteria();
		$criteria->condition = 'id_radiostation = :id_radiostation';
		$criteria->params = array(':id_radiostation'=>$model->id_radiostation);
		$radiosetings=RadiostationSettings::model()->find($criteria);
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
		$testsongs=$test->songs;//список тестируемых песен
		$test=array();
		foreach($testsongs as $songs){
			$test[]=$songs->id_song;//список айдишников тестируемых песен
		}
		$con=count($test); //количество тестируемых песен

		$soundtest=array_rand($test, 1); //выбираем случайную песню
		if(!Yii::app()->request->cookies['soundtest']) {
			$cookie = new CHttpCookie('soundtest', $soundtest);//устанавливаем куки тестируемой песни на 30 мин
			$cookie->expire = time() + 1800;
			Yii::app()->request->cookies['soundtest'] = $cookie;

			$cookie = new CHttpCookie('test',serialize($test));//устанавливаем куки масива песен на 30 мин
			$cookie->expire = time() + 1800;
			Yii::app()->request->cookies['test'] = $cookie;

			$dur = 0;
			$session = new CHttpSession;
			$session->open();
			$session['dur'] = $dur;
			$session['time'] = time();
			$session['con']=$con;
			//$cookie = new CHttpCookie('dur', $dur);//устанавливаем куки  защита от дураков на 30 мин
			//$cookie->expire = time() + 1800;
			//Yii::app()->request->cookies['dur']=$cookie;

			$last = 0;
			$session['last'] = $last;
			//$cookie = new CHttpCookie('last', $last);//устанавливаем куки  последнего ответа на 30 мин
			//$cookie->expire = time() + 1800;
			//Yii::app()->request->cookies['last']=$cookie;

			$like = array();

			$cookie = new CHttpCookie('like', serialize($like));//устанавливаем куки масива ответов на 30 мин
			$cookie->expire = time() + 1800;
			Yii::app()->request->cookies['like'] = $cookie;

			$cookie = new CHttpCookie('never', serialize($never=array()));//устанавливаем куки масива ответов на 30 мин
			$cookie->expire = time() + 1800;
			Yii::app()->request->cookies['never'] = $cookie;

			$cookie = new CHttpCookie('date_last', serialize($date_last=array()));//устанавливаем куки масива ответов на 30 мин
			$cookie->expire = time() + 1800;
			Yii::app()->request->cookies['date_last'] = $cookie;
		}
		if($mix=Mixmarker::model()->findbyPk($r))
			$sound="<div class='
        <div class='lm-track lmtr-top'>
            <audio id='player_".$mix->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $mix->name." autoplay></audio>
</div>
</div>".Yii::t('radio', 'I will now play songs to you. Check now, that your speakers are turned on and the volume is not too loud. After listening to each song, I will ask you a few questions.Thank you for your time!');

		$this->render('index',array('model'=>$sound,'message'=>Yii::t('radio', 'Songs'),'buton'=>'Songs'));
	}

}
	public function actionSongs(){
		//перебор песен теста
		if(Yii::app()->request->cookies['test']){
			$sound=Yii::app()->request->cookies['soundtest']->value;
			$test=unserialize(Yii::app()->request->cookies['test']->value);
			if(!isset($test[$sound])){
				$this->redirect('finish');
			}
			$session = new CHttpSession;
			$session->open();

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

			$model->id_song=$test[$sound];
			$song=Songs::model()->findByPk($test[$sound])->song_file;

			$song="/".stristr($song,'musictest');
			$song=str_replace('\\','/',$song);
			if(isset($_POST['yt1'])){
				$ansver=5;
			}
			if(isset($_POST['yt2'])){
				$ansver=4;
			}
			if(isset($_POST['yt3'])){
				$ansver=3;
			}
			if(isset($_POST['yt4'])){
				$ansver=2;
			}
			if(isset($_POST['yt5'])){
				$ansver=1;
			}
			if(isset($_POST['never'])){
				$model->never=5;
			}
			if(isset($ansver))
			{
				$session['old_sound']=$sound;// последний музікальній тест
				$session['old_test']=Yii::app()->request->cookies['test']->value;// список последних осташихся
				$model->id_like=$ansver;
				$model->date_last=date(" Y-m-d");

				if($model->validate()){
					unset($test[$sound]);
						if(count($test))
					$soundtest=array_rand($test, 1); //выбираем случайную песню
					else $soundtest=0;

					$cookie = new CHttpCookie('soundtest', $soundtest);//устанавливаем куки тестируемой песни на 30 мин
					$cookie->expire = time() + 1800;
					Yii::app()->request->cookies['soundtest']=$cookie;

						$cookie = new CHttpCookie('test', serialize($test));//устанавливаем куки масива песен на 30 мин
						$cookie->expire = time() + 1800;
						Yii::app()->request->cookies['test'] = $cookie;



					if($session['last']==$model->id_like ){
						$session['dur']++;

						if($session['dur']>=5){
							$session['baned']=true;
						}
					}

					$like=unserialize(Yii::app()->request->cookies['like']->value);
					$like[$model->id_song]=$model->id_like;
					$cookie = new CHttpCookie('like',serialize($like));//устанавливаем куки масива ответов песни на 30 мин
					$cookie->expire = time() + 1800;
					Yii::app()->request->cookies['like']=$cookie;

					$never=unserialize(Yii::app()->request->cookies['never']->value);
					$never[$model->id_song]=$model->never;
					$cookie = new CHttpCookie('never',serialize($never));//устанавливаем куки масива ответов песни на 30 мин
					$cookie->expire = time() + 1800;
					Yii::app()->request->cookies['never']=$cookie;

					$date_last=unserialize(Yii::app()->request->cookies['date_last']->value);
					$date_last[$model->id_song]=$model->date_last;
					$cookie = new CHttpCookie('date_last',serialize($date_last));//устанавливаем куки масива ответов песни на 30 мин
					$cookie->expire = time() + 1800;
					Yii::app()->request->cookies['date_last']=$cookie;

					//$ans=array('date_last'=>$model->date_last,'id_like'=>$model->id_like,'never'=>$model->never);
					//$ansver[$model->id_song]=$ans;
					//$cookie = new CHttpCookie('ansver',serialize($ansver));//устанавливаем куки масива ответов песни на 30 мин
					//$cookie->expire = time() + 1800;
					///Yii::app()->request->cookies['ansver']=$cookie;
					$this->redirect(array('/test/Songs'));
				}

			}

			$this->render('create',array(
				'model'=>$model,'song'=>$song,'progress'=>$progress,
			));
		}
		else{
			$this->redirect('finish');
		}


	}
	public function actionRepeat(){
		$session = new CHttpSession;
		$session->open();

$test=unserialize(Yii::app()->request->cookies['test']->value);
		if($session['con']!=count($test)){
			$cookie = new CHttpCookie('test', $session['old_test']);//устанавливаем куки масива песен на 30 мин
		$cookie->expire = time() + 1800;
		Yii::app()->request->cookies['test'] = $cookie;
		$cookie = new CHttpCookie('soundtest', $session['old_sound']);//устанавливаем куки масива песен на 30 мин
		$cookie->expire = time() + 1800;
		Yii::app()->request->cookies['soundtest'] = $cookie;
		$like = unserialize(Yii::app()->request->cookies['like']->value);
		array_pop($like);
		$cookie = new CHttpCookie('like', serialize($like));//устанавливаем куки масива песен на 30 мин
		$cookie->expire = time() + 1800;
		Yii::app()->request->cookies['like'] = $cookie;
	}
		$this->redirect('Songs');

	}
	public function actionFinish(){
		if($like=Yii::app()->request->cookies['like']){
			$like=unserialize($like->value);
			$never=unserialize(Yii::app()->request->cookies['never']->value);
			$date_last=unserialize(Yii::app()->request->cookies['date_last']->value);

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
			$usertest->time=time()-$session['time'];
			$usertest->save();
			foreach($like as $key=>$an){
				$model=new MusicTestDetail();
				$model->id_like=$an;
				$model->never=$never[$key];
				$model->id_song=$key;
				$model->date_last=$date_last[$key];
				$model->id_user=$user->id_user;
				$model->id_test=$test->id_test;
				$model->finaly=date(" Y-m-d");
				$model->save();
			}
			$user->link='';
			$user->save();

			$text=$user->radio->settings->text_after_test;
			$this->render('finish',array('model'=>$text,'message'=>''));
		}
	}
}