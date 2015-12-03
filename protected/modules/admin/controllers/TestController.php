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