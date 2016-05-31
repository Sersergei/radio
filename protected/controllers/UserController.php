<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 25.01.2016
 * Time: 23:43
 */
class UserController extends Controller
{
    public function actionUpdate($id=Null,$link=Null)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            if($model->save())
                $this->redirect(array('/test/index/id/'.$id.'/linc/'.$link));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
    public function loadModel($id)
    {
        $model=Users::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    public function actionLogin()
    {
        if (Yii::app()->user->isGuest) {
            $model=new LoginForm;

            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            // collect user input data
            if(isset($_POST['LoginForm']))
            {
                $model->attributes=$_POST['LoginForm'];

                // validate user input and redirect to the previous page if valid
                $identity=new UserIdentity($model->username,$model->password);

                if($identity->authenticate()) {
                    Yii::app()->user->login($identity);
                    $this->redirect(Yii::app()->user->returnUrl);
                }

                else
                    Yii::app()->user->setFlash('error',Yii::t('radio','Неправильное имя пользователя или пароль'));
            }
            // display the login form
            $this->render('login',array('model'=>$model));
        }
        else{

            $this->render('index',array());
        }
    }

}