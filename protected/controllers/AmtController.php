<?php

class AmtController extends Controller
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

        $settings = Radistations::model()->findbyPk($id);
        $criteria = new CDbCriteria();
        $criteria->compare ('id_radiostation',$id);
        $criteria->compare('id_type',2);
       $criteria->compare('id_status',2);
       // $criteria->params = array(':id_radiostation' => $id,);
        $test =MusicTest::model()->find($criteria);

        if($test){
        if ($settings) {
            $session = new CHttpSession;
            $session->open();
            $session['radiostation'] = serialize($settings);

            $criteria = new CDbCriteria();
            $criteria->condition = 'id_radiostation = :id_radiostation';
            $criteria->params = array(':id_radiostation' => $id);
            $radiostationSettings = RadiostationSettings::model()->find($criteria);
            // var_dump($radiostationSettings->not_use_music_marker);
            if ($radiostationSettings) {
                if($radiostationSettings->id_card_registration){

                    $this->redirect('Idcard');
                }
                $this->redirect('/Amt/Viewregister');
        } else {
                $this->render('message',array('message'=>Yii::t('radio','Извините на данный момент регистрация закрыта ведеться настройка тестирования')));
        }
    }
        else
        $this->render('message',array('message'=>Yii::t('radio','Извините на данный момент регистрация закрыта ведеться настройка тестирования')));
    }
    else
        $this->render('message',array('message'=>Yii::t('radio','На данный момент нет активного AMT теста')));


}

    public function actionViewregister(){

        $session=new CHttpSession;
        $session->open();

        if(isset($session['radiostation'])) {


            $model = new Users;
            $radio=unserialize($session['radiostation']);

            $model->id_category=4;
            $model->id_radiostation=$radio->id_radiostation;

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
                //var_dump($_POST['Users']['email']);

                $criteria = new CDbCriteria;
                $criteria->compare('email', $_POST['Users']['email']);
                $user=Users::model()->find($criteria);

                if($user){
                    $model=$user;

                }

                $model->P1='+';
                $model->id_radiostation=$radio->id_radiostation;
                $model->scenario = 'user';
                $model->marker=$session['marker'];
                $model->attributes = $_POST['Users'];
                $model->date_birth=$_POST['date_birth'];
                $model->link=md5(microtime().$model->name_listener.'rfvbgt');
                $model->status=1;//забанен
                if ($model->save()){

                    $this->redirect(array('/test/index/id/'.$model->id_user.'/linc/'.$model->link));
                }

            }

            $this->render('create', array(
                'model' => $model,
            ));
        }
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
$this->redirect(array('AMT/Viewregister'));
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
                $this->redirect(array('AMT/Viewregister'));
            }
            }
        $this->render('idcard',array('model'=>$model));
    }



}