<?php

class RegisterController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }


    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($id)

    {

        $model = new Users();
        $model->id_radiostation = $id;
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $settings = Radistations::model()->findbyPk($id);



        if ($settings) {
            $session = new CHttpSession;
            $session->open();
            $session['radiostation'] = serialize($settings);

            $criteria = new CDbCriteria();
            $criteria->condition = 'id_radiostation = :id_radiostation';
            $criteria->params = array(':id_radiostation' => $id);
            $radiostationSettings = RadiostationSettings::model()->find($criteria);

            if ($radiostationSettings) {


            if ($radiostationSettings->not_use_music_marker){
                if($radiostationSettings->id_card_registration){

                    $this->redirect('Idcard');
                }
                $this->redirect('Viewregister');
            }

            else $this->redirect('ChoosingMix');
        } else {
                $this->render('message',array('message'=>Yii::t('radio','Извините на данный момент регистрация закрыта ведеться настройка тестирования')));
        }
    }
        else
        $this->render('message',array('message'=>Yii::t('radio','Извините на данный момент регистрация закрыта ведеться настройка тестирования')));
    }
    public function actionChoosingMix(){

        $session=new CHttpSession;
        $session->open();
        $radio=unserialize($session['radiostation']);
        $bed_mixmarker=unserialize($radio->radiostationSettings->bed_mixmarker);
        $god_mixmarker=unserialize($radio->radiostationSettings->god_mixmarker);
        $mixmarker=$radio->radiostationSettings->mix_marker;
        if($mixmarker){
            $god_mixmarker[]=$mixmarker;
        }

        $arr=array_merge($bed_mixmarker,$god_mixmarker);
        shuffle($arr); //РІС‹РІРµР»Рё РїРµСЂРµРјРµС€Р°РЅС‹Р№ РјР°СЃРёРІ РёР· РјРёРєСЃРјР°СЂРєРµСЂРѕРІ;
        $criteria=new CDbCriteria;
        $criteria->addInCondition('id',$arr);
        $model=Mixmarker::model()->findAll($criteria);
        $mix=$this->mixmsrker($model);
        $models=new Mix;

        if (isset($_POST['yt0'])) {
            if (isset($_POST['mixmarker']))
            $models->mixmarker = $_POST['mixmarker'];
            if ($models->validate()){
                if(in_array($models->mixmarker,$bed_mixmarker)){
                    $session['marker']='-';
                }
                elseif($models->mixmarker==$mixmarker){
                    $session['marker']='+';
                }
                else $session['marker']=0;

                $radiostation=unserialize($session['radiostation']);

                    if($radiostation->radiostationSettings->id_card_registration){

                        $this->redirect('Idcard');
                    }
                $this->redirect('Viewregister');
            }

        }
        $this->render('view',array('model'=>$models,'arr'=>$arr,'mix'=>$mix));



    }
    public function actionViewregister(){

        $session=new CHttpSession;
        $session->open();

        if(isset($session['radiostation'])) {


            $model = new Users;
            $radio=unserialize($session['radiostation']);
            $model->id_radiostation=$radio->id_radiostation;
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
            if (isset($_POST['Users'])) {

                $model->scenario = 'user';
                $model->marker=$session['marker'];
                $model->attributes = $_POST['Users'];
                $model->date_birth=$_POST['date_birth'];
                $model->status=1;//забанен
                if ($model->save()){
                    new EmailActive($model);
                    $this->redirect(array('Message'));
                }

            }

            $this->render('create', array(
                'model' => $model,
            ));
        }
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

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
        {
            if( !empty($_POST['Users']['radiostation']) !=='admin'){
                $model->setScenario ('noadmin');
            }
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionFacebook(){

if($_GET['code']){
    $face=new ServiceUserIdentity();
$result=$face->getToken($_GET['code']);

    //$convertedText = mb_convert_encoding($result->name, 'utf8', mb_detect_encoding($result->name));

    $session=new CHttpSession;
    $session->open();
    if(isset($result->name))
    $session['name']=$result->name;
    if(isset($result->email))
    $session['email']=$result->email;
    if(isset($result->birthday)){
        $date=$pieces = explode("/", $result->birthday);
        $date=$date[2]."-".$date[0]."-".$date[1];
        $session['bersday']=$date;
    }

}
        else {
            exit ('Ошибка параметров');
        }
$this->redirect(array('register/Viewregister'));
    }
    public function actionIdcard(){
        $model=new Idcard;
        if (isset($_POST['Idcard'])) {
            $model->attributes = $_POST['Idcard'];
            if($model->validate()){


            $session=new CHttpSession;
            $session->open();
           /* Там всё просто XYYMMDDZZZC Х пол 1 мужики 21 века,
            2 женщины 21 века, 3 мужики 20 века, 4 женщины 20 века,
            YY-год рождения, MM - месяц рождения,
            DD - дата рождения,
           ZZZ - нам не нужно и
           С - сумма всех чисел карты, проверочный код

*/
            $sex=$model->card{0};
            if($sex==1){
                $session['sex']=1;
                $er=20;
            }elseif($sex==2){
                $session['sex']=2;
                $er=20;
            }elseif($sex==3){
                $session['sex']=1;
                $er=19;
            }elseif($sex==4){
                $session['sex']=2;
                $er=19;
            }
            $session['bersday']=$er.$model->card{1}.$model->card{2}."-".$model->card{3}.$model->card{4}."-".$model->card{5}.$model->card{6};
                $this->redirect(array('register/Viewregister'));
            }
            }
        $this->render('idcard',array('model'=>$model));
    }

    public function actionMessage(){
        $message=Yii::t('radio','To complete the registration click on the link in the email');
        $this->render('message',array('message'=>$message));
    }
    public function actionActive($id=NULL,$linc=NULL){
    $criteria=new CDbCriteria();
    $criteria->condition = 'id_user = :id AND activate = :activate';
    $criteria->params = array(':id'=>$_GET['id'], ':activate'=>$_GET['linc']);
    $model=Users::model()->find($criteria);
    if($model){
        $model->status=Null;
        $model->save();
        $message=Yii::t('radio','Thank you! The invitation to test you come to the email');
        $this->render('message',array('message'=>$message));
    }
    else{
        $message=Yii::t('radio','Sorry link is not valid registration go again');
        $this->render('message',array('message'=>$message));
    }


}
    public function actionDisActive($id=NULL,$linc=NULL){
        $criteria=new CDbCriteria();
        $criteria->condition = 'id_user = :id AND activate = :activate';
        $criteria->params = array(':id'=>$_GET['id'], ':activate'=>$_GET['linc']);
        $model=Users::model()->find($criteria);
        if($model){
            $model->status=1;
            $model->save();
            $message=Yii::t('radio','We canceled subscribe');
            $this->render('message',array('message'=>$message));
        }
        else{
            $message=Yii::t('radio','Sorry link is not valid registration go again');
            $this->render('message',array('message'=>$message));
        }


    }

    public function actionUpdate($id=Null,$linc=Null)
    {
        $model=$this->loadModel($id);
        if($model->link==$linc){
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->region='';
        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            $model->date_birth=$_POST['date_birth'];
            $model->scenario = 'user';
            if($model->save())
                $this->redirect(array('/test/index/id/'.$id.'/linc/'.$model->link));
        }

        $this->render('update',array(
            'model'=>$model,
        ));}
    }
    public function loadModel($id)
    {
        $model=Users::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }


}