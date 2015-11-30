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

        $model=new Users();
        $model->id_radiostation=$id;
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
    $settings=Radistations::model()->findbyPk($id);
        if($settings){
            $session=new CHttpSession;
            $session->open();
            $session['radiostation']=serialize($settings);

            $criteria = new CDbCriteria();
            $criteria->condition = 'id_radiostation = :id_radiostation';
            $criteria->params = array(':id_radiostation' => $id);
            $radiostationSettings=RadiostationSettings::model()->find($criteria);
           // var_dump($radiostationSettings->not_use_music_marker);

            if(!$radiostationSettings->not_use_music_marker)
                $this->redirect('Viewregister');
            else $this->redirect('ChoosingMix');
        }
       else{
           $error=Yii::t('radio','404 ERROR');
           $this->render('Error', $error);
       }


    }
    public function actionChoosingMix(){

        $session=new CHttpSession;
        $session->open();
        $radio=unserialize($session['radiostation']);
        $bed_mixmarker=unserialize($radio->radiostationSettings->bed_mixmarker);
        $god_mixmarker=unserialize($radio->radiostationSettings->god_mixmarker);
        $mixmarker=$radio->radiostationSettings->mix_marker;
        $god_mixmarker[]=$mixmarker;
        shuffle($bed_mixmarker);
        $i=5-count($god_mixmarker);
        while (count($bed_mixmarker)>$i){
            array_pop($bed_mixmarker);
        }
        $arr=array_merge($bed_mixmarker,$god_mixmarker);
        shuffle($arr); //вывели перемешаный масив из миксмаркеров;
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
                if ($model->save())
                    $this->redirect(array('Message'));
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }
    }
    protected function mixmsrker($model){
        foreach($model as $mix){
            $array[$mix->id] ='<audio src=../../mixmarker/'. $mix->name . ' controls></audio>';
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
    public function actionMessage(){
        $message=Yii::t('radio','Спасибо за регистрацию приглашение на тестирование вам прийдет на почту');
        $this->render('message',array('message'=>$message));
    }

}