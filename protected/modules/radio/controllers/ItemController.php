<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.02.2016
 * Time: 19:21
 */
class ItemController extends  CController
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules()
    {
        return array(

            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create'),
                'users'=>array('@'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function actionCreate(){
        $user=Users::model()->findByPk(Yii::app()->user->id);
        $href=Yii::app()->getBaseUrl(true)."/register/".$user->id_radiostation."?lang=".$user->radio->lang->lang;
        $model=Radistations::model()->findByPk($user->id_radiostation);
        $baner=Null;
        if(!$model)
            throw new CHttpException(404);
        $model->setScenario('image');
        if(isset($_POST['Radistations'])){
            $model->attributes=$_POST['Radistations'];
            $model->image=CUploadedFile::getInstance($model,'image');
            if($model->save()){
                $dir=Yii::getPathOfAlias('webroot').'/img/'.$model->id_radiostation;
                if(!file_exists ($dir) )
                    mkdir($dir);
                $path=$dir.'/'.$model->image->getName();
                $model->image->saveAs($path);
                // ?????????????? ?? ????????, ??? ??????? ????????? ??
                // ???????? ????????
            }
            else{
                $model->image=Null;
            }

        }
        if($model->image) {
            $img = Yii::app()->getBaseUrl(true) . '/img/' . $model->id_radiostation . '/' . $model->image;
            $baner = "<a href='$href' target='_blank'><img src='$img' alt='RadioMusicTest' width=500px height=200px  /></a>";
        }
        $this->render('create', array('model'=>$model,'baner'=>$baner,));
    }


}