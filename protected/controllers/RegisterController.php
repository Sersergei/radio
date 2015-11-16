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
            $session['radiostation']=$id;
           // if($settings->radiostationSettings->not_use_music_marker)
                $this->redirect('Viewregister');
        }
       else{
           $error=Yii::t('radio','404 ERROR');
           $this->render('error', $error);
       }


    }
    public function actionViewregister(){
        $session=new CHttpSession;
        $session->open();
        if(isset($session['radiostation'])) {


            $model = new Users;
            $model->id_radiostation=$session['radiostation'];
            $model->id_category=3;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if (isset($_POST['Users'])) {
                $model->scenario = 'user';
                $model->attributes = $_POST['Users'];
                if ($model->save())
                    $this->redirect(array('/site/mesage', 'id' => $model->id_user));
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




}