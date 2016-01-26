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

}