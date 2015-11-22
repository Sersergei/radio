<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 22.11.2015
 * Time: 17:00
 */
class TestController extends Controller
{
    public function actionIndex()
    {
        $model=new Usertest('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Usertest']))
            $model->attributes=$_GET['Usertest'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

}