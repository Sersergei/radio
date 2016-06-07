<?php

/**
 * Created by PhpStorm.
 * User: ������
 * Date: 22.11.2015
 * Time: 17:00
 */
class TestController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function actionIndex()
    {
        $model = new Usertest('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Usertest']))
            $model->attributes = $_GET['Usertest'];
       if (isset($_GET['file'])) {
            $outputFile = 'test.csv';
            $cmd = Yii::app()->db->createCommand("SELECT t.id,u.name_listener,u.email,u.sex,r.name,t.id_music,t.date,t.time FROM Usertest as t,Users as u, radistations as r WHERE t.id_user=u.id_user and u.id_radiostation=r.id_radiostation");
            $csv = new ECSVExport($model->search());
            $csv->setOutputFile($outputFile);
            $csv->toCSV();

            Yii::app()->request->sendFile($outputFile, file_get_contents(Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $outputFile));
        }

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

}