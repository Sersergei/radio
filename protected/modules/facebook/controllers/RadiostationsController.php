<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.05.2016
 * Time: 0:05
 */
class RadiostationsController  extends Controller
{

    public $layout='/layouts/column2';
    public function actionIndex($id=NULL){
        $session = new CHttpSession;
        $session->open();
        $session['radio']=$id;
        $model=Radistations::model()->findByPk($id);
        $r=$model->settings->text_before_test;
        $this->render('index',array('model'=>$r,'message'=>'','buton'=>'Songstest'));
    }
    public function actionSongstest(){
        $session = new CHttpSession;
        $session->open();
//????? ????? ??? ????????? ?????
            $criteria=new CDbCriteria();
            $criteria->condition = 'id_radiostation = :id_radiostation';
            $criteria->params = array(':id_radiostation'=>$session['radio']);
            $radiosetings=RadiostationSettings::model()->find($criteria);

                //???? ?? ????? ??????? ???????? ??????????
                $session['never_test']=$radiosetings->never_test;

            if(!$r=$radiosetings->gettestsongs())
                $sound=Yii::t('radio', '????? ??? ???????????? ?? ???????');

            $criteria=new CDbCriteria();
            $criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
            $criteria->params = array(':id_radiostation'=>$session['radio'], ':id_status'=>2);
            $test=MusicTest::model()->find($criteria);
            $test=$test->songs;//?????? ??????????? ?????


            $con=count($test); //?????????? ??????????? ?????

            $soundtest=array_rand($test, 1); //???????? ????????? ?????
            $session['soundtest']= $soundtest;//????????????? ???? ??????????? ????? ?? 30 ???
            $session['test']=serialize($test);//????????????? ???? ?????? ????? ?? 30 ???
            $dur = 0;

            $session['dur'] = 0;
            $time=new DateTime();
            $cookie = new CHttpCookie('time',serialize($time));//????????????? ???? ????? ?? 30 ???
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


    public function actionSongs(){
        $session = new CHttpSession;
        $session->open();
        //??????? ????? ?????
        if($session['test']){

            $sound=$session['soundtest'];
            $test=unserialize($session['test']);
            if(!isset($test[$sound])){
                $this->redirect('ChoosingMix');
            }


            $con=$session['con'];
            $progress=100-((count($test)/$con)*100);

            //$user=Yii::app()->request->cookies['user'];
            //$user=$user->value;
            //$user=Users::model()->findByPk($user);
            //??????????? ?????? ????
            $criteria=new CDbCriteria();
            $criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
            $criteria->params = array(':id_radiostation'=>$session['radio'], ':id_status'=>2);
            $musictest=MusicTest::model()->find($criteria);
            $model=new MusicTestDetail();
            $model->id_test=$musictest->id_test;
            //$model->id_user=$user->id_user;

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

                $session['old_sound']=$sound;// ????????? ??????????? ????
                $session['old_test']=$session['test'];// ?????? ????????? ?????????


                $model->date_last=date(" Y-m-d");

                if($model->validate()){
                    unset($test[$sound]);
                    if(count($test))
                        $soundtest=array_rand($test, 1); //???????? ????????? ?????
                    else $soundtest=0;

                    $session['soundtest']=$soundtest;//????????????? ???? ??????????? ????? ?? 30 ???


                    $session['test']= serialize($test);//????????????? ???? ?????? ????? ?? 30 ???

                    if($session['testresult'])
                        $testresult=unserialize($session['testresult']);
                    $testresult[]=$model;

                    $session['testresult']=serialize($testresult);
                    $this->redirect(array('radiostations/Songs'));
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

            $this->redirect('authentication');
        }
    }
    public function actionRepeat(){
        $session = new CHttpSession;
        $session->open();

        $test=unserialize($session['test']);
        if($session['con']!=count($test)){
            $session['test']= $session['old_test'];//????????????? ???? ?????? ????? ?? 30 ???

            $session['soundtest']= $session['old_sound'];//????????????? ???? ?????? ????? ?? 30 ???

            $testresult=unserialize($session['testresult']);
            array_pop($testresult);
            $session['testresult']=serialize($testresult);

        }
        $this->redirect('Songs');

    }
    public function actionAuthentication(){
        $session = new CHttpSession;
        $session->open();

        $session['ferst_test']=1;
        $model=new Email();
        if (isset($_POST['Email'])) {
            $model->attributes=$_POST['Email'];
            if($model->validate()){
                $session['email']=$model->email;
                $criteria = new CDbCriteria();
                $criteria->condition = 'id_radiostation = :id_radiostation';
                $criteria->params = array(':id_radiostation' => $session['radio']);
                $radiostationSettings = RadiostationSettings::model()->find($criteria);

                if ($radiostationSettings) {


                    if ($radiostationSettings->not_use_music_marker){

                        $this->redirect('Viewregister');
                    }

                    else $this->redirect('ChoosingMix');
                }
                else {
                    $this->render('message',array('message'=>Yii::t('radio','???????? ?? ?????? ?????? ??????????? ??????? ???????? ????????? ????????????')));
                }
            }


        }

        $this->render('authentication',array('model'=>$model));
    }
    public function actionChoosingMix(){

        $session=new CHttpSession;
        $session->open();
        $radio=Radistations::model()->findByPk($session['radio']);
        $bed_mixmarker=unserialize($radio->radiostationSettings->bed_mixmarker);
        $god_mixmarker=unserialize($radio->radiostationSettings->god_mixmarker);
        $mixmarker=$radio->radiostationSettings->mix_marker;
        if($mixmarker){
            $god_mixmarker[]=$mixmarker;
        }

        $arr=array_merge($bed_mixmarker,$god_mixmarker);
        shuffle($arr); //???�???�?�?? ???�???�???�?�?�???�?? ???�?????? ???� ???????????�?????�??????;
        $criteria=new CDbCriteria;
        $criteria->addInCondition('id',$arr);
        $model=Mixmarker::model()->findAll($criteria);
        $mix=$this->mixmsrker($model);
        $models=new Mix;

        if (isset($_POST['yt0'])) {
            if (isset($_POST['mixmarker']))
                $models->mixmarker = $_POST['mixmarker'];
            if ($models->validate()){
                $session['id_mix']=$models->mixmarker;
                if(in_array($models->mixmarker,$bed_mixmarker)){
                    $session['marker']='-';
                }
                elseif($models->mixmarker==$mixmarker){
                    $session['marker']='+';
                }
                else $session['marker']=0;

                $radiostation=unserialize($session['radiostation']);

                $this->redirect('Viewregister');
            }

        }
        $this->render('view',array('model'=>$models,'arr'=>$arr,'mix'=>$mix));



    }
    protected function mixmsrker($model){
        foreach($model as $mix){
            $name=explode(".",$mix->name);
            $name=$name[0];
            $i=preg_replace("/[0-9]/","", $name);
            $array[$mix->id] ="<div class='lm-inner clearfix'>

         <div class='mini_controls'>
                <a href='javascript:void(0)' class='mini-play' style='display:block ;' onclick=\"var x= document.getElementById('player_".$mix->id."'); play(x);\"></a>
                <a href='javascript:void(0)' class='mini-pause' style='display:none ;' onclick=\"document.getElementById('player_".$mix->id."').pause()\"></a>
            </div>
        <div class='lm-track lmtr-top'>
            <audio id='player_".$mix->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $mix->name." ></audio>
</div>
</div>";
        }

        return $array;
    }
    public function actionViewregister(){

        $session=new CHttpSession;
        $session->open();

        if(isset($session['radio'])) {

            $session = new CHttpSession;
            $session->open();
            $criteria=new CDbCriteria();
            $criteria->condition = 'email = :email AND id_radiostation = :id_radiostation';
            $criteria->params = array(':id_radiostation'=>$session['radio'], ':email'=>$session['email']);
            $model = User_ferst_test::model()->find($criteria);
            if(!$model)
                $model=new User_ferst_test();
            $model->id_radiostation=$session['radio'];
            $model->id_category=3;

            if(isset($session['sex'])){
                $model->sex=$session['sex'];
            }
            if(isset($session['name']))
                $model->name_listener=$session['name'];
            if(isset($session['email']))
                $model->email=$session['email'];
            if(isset($session['bersday']))
                $model->date_birth=$session['bersday'];
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['Users']) or isset($_POST['User_ferst_test'])) {
                $model->scenario = 'user';
                $model->marker=$session['marker'];
                $model->mix_marker=$session['id_id_mix'];
                if(isset($_POST['Users']))
                $model->attributes = $_POST['Users'];
                if(isset($_POST['User_ferst_test']))
                    $model->attributes = $_POST['User_ferst_test'];
                $model->date_birth=$_POST['date_birth'];
                if(isset($_POST['User_ferst_test'])){
                    if(!isset($session['bersday']))
                        $model->status=1;//???????
                }
                if ($model->save()){
                    if(isset($_POST['User_ferst_test']))
                    new EmailActive($model);

                    $this->redirect(Yii::app()->createUrl('radiostations/Finish',array('id_user'=>$model->id_user)));
                }

            }

            $this->render('register', array(
                'model' => $model,
            ));
        }
    }
    public function actionFinish($id_user){
        $session=new CHttpSession;
        $session->open();

        if($session['testresult']) {


            $date_last = $session['date_last'];


            $criteria = new CDbCriteria();
            $criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
            $criteria->params = array(':id_radiostation' => $session['radio'], ':id_status' => 2);
            $test = MusicTest::model()->find($criteria);

            $criteria = new CDbCriteria();
            $criteria->condition = 'id_music = :id_music AND id_user = :id_user';
            $criteria->params = array(':id_music' => $test->id_test, ':id_user' => $id_user);
            $usertest = Usertest::model()->find($criteria);
            if (!$usertest) {


                $usertest = new Usertest();
                $usertest->id_user = $id_user;
                $usertest->id_music = $test->id_test;
                $usertest->date = date(" Y-m-d");
                $time = Yii::app()->request->cookies['time'];
                $time = $time->value;
                $time1 = unserialize($time);
                $time2 = new DateTime();
                $interval = $time1->diff($time2);
                $usertest->time = $interval->format('%H:%I:%S');
                $usertest->ip = sprintf('%u', ip2long(Yii::app()->request->userHostAddress));

                $usertest->save();
                ($usertest->getErrors());
                $testresult = unserialize($session['testresult']);
                //print_r($testresult);
                foreach ($testresult as $models) {

                    $models->finaly = date(" Y-m-d");
                    $models->id_user=$id_user;
                    $models->save();
                }

                unset($session['testresult']);
                //Yii::app()->request->cookies->remove('like');
                //$like->remove;
                $radio = Radistations::model()->findByPk($session['radio']);
                $text = $radio->settings->text_after_test;
                $message = new Messages();
                $this->render('finish', array('model' => $text, 'message' => '', 'messages' => $message,));

            }
        }
    }
}