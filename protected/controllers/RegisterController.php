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

            if($settings->radiostationSettings->not_use_music_marker)
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
        shuffle($arr); //������ ����������� ����� �� ������������;
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

        $service = Yii::app()->request->getQuery('service');
        if (isset($service)) {
            $authIdentity = Yii::app()->eauth->getIdentity($service);
            //$authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('register/Viewregister');
            //var_dump($authIdentity->isAuthenticated);
            if ($authIdentity->authenticate()) {
                $session=new CHttpSession;
                $session->open();
                $session['userdate']=$authIdentity->getAttribute('name');
                $this->redirect(array('register/Viewregister'));

            }

            // ���-�� ����� �� ���, �������������� �� �������� �����
            $this->redirect(array('register/Viewregister'));
        }
        $session=new CHttpSession;
        $session->open();
        var_dump($session['userdate']);
        if(isset($session['radiostation'])) {


            $model = new Users;
            $radio=unserialize($session['radiostation']);
            $model->id_radiostation=$radio->id_radiostation;
            $model->id_category=3;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['Users'])) {
                $model->scenario = 'user';
                $model->marker=$session['marker'];
                $model->attributes = $_POST['Users'];
                if ($model->save())
                    $this->redirect(array('/site/mesage', 'id' => $model->id_user));
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




}