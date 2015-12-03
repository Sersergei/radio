<?php

class TestController extends Controller
{
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
		$r=$radiosetings->test_song;//песня для тестирования музыки
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
			//$cookie = new CHttpCookie('dur', $dur);//устанавливаем куки  защита от дураков на 30 мин
			//$cookie->expire = time() + 1800;
			//Yii::app()->request->cookies['dur']=$cookie;

			$last = 0;
			$session['last'] = $last;
			//$cookie = new CHttpCookie('last', $last);//устанавливаем куки  последнего ответа на 30 мин
			//$cookie->expire = time() + 1800;
			//Yii::app()->request->cookies['last']=$cookie;

			$ansver = array();
			$cookie = new CHttpCookie('ansver', serialize($ansver));//устанавливаем куки масива ответов на 30 мин
			$cookie->expire = time() + 1800;
			Yii::app()->request->cookies['ansver'] = $cookie;
		}
		if($mix=Mixmarker::model()->findbyPk($r))

			$sound='<audio src=../../mixmarker/'. $mix->name . ' controls></audio><br>'.Yii::t('radio', 'Если вы слышите песню можете начинать тестирование');
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

			if(isset($_POST['MusicTestDetail']))
			{

				$model->attributes=$_POST['MusicTestDetail'];
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


					$session = new CHttpSession;
					$session->open();
					if($session['last']==$model->id_like ){
						$session['dur']++;

						if($session['dur']>=5){
							$session['baned']=true;
						}
					}

					$ansver=unserialize(Yii::app()->request->cookies['ansver']->value);
					$ans=array('date_last'=>$model->date_last,'id_song'=>$model->id_song,'id_like'=>$model->id_like);
					$ansver[]=$ans;
					$cookie = new CHttpCookie('ansver',serialize($ansver));//устанавливаем куки масива ответов песни на 30 мин
					$cookie->expire = time() + 1800;
					Yii::app()->request->cookies['ansver']=$cookie;
					$this->redirect(array('/test/Songs'));
				}

			}

			$this->render('create',array(
				'model'=>$model,'song'=>$song,
			));
		}
		else{
			$this->redirect('finish');
		}


	}
	public function actionFinish(){
		if($ansver=Yii::app()->request->cookies['ansver']){
			$ansver=unserialize($ansver->value);

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
			foreach($ansver as $an){
				$model=new MusicTestDetail();
				$model->attributes=$an;
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