<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 05.11.2015
 * Time: 1:10
 */
class Databese{
    public function actionIndex(){
        $this->render('index',array('model'=>$model));
    }
}