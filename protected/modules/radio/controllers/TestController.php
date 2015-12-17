<?php

/**
 * Created by PhpStorm.
 * User: ������
 * Date: 22.11.2015
 * Time: 17:00
 */
class TestController extends Controller
{
    public function actionIndex($id)
    {
        $model = new Usertest('search');
        $model->unsetAttributes();  // clear any default values
        $model->id_music=$id;
        if (isset($_GET['Usertest']))
            $model->attributes = $_GET['Usertest'];
       if (isset($_GET['file'])) {

           $this->widget('EExcelView', array(
               'id'=>'provider-problem-grid',
               'dataProvider'=>$model->search(),
               'grid_mode' => 'export',
               'filename' => 'report',
               'filter'=>$model,
               'title'=>'',
               'autoWidth'=>false,
               'stream' => true,
               'exportType' => $_GET['type'],
               'template'=>"{items}\n{exportbuttons}\n{pager}",
               'columns'=>array(
                   array(
                       'name' => 'user',
                       'type' => 'raw',
                       'value' => '$data->user->name_listener',
                   ),
                   array(
                       'name' => 'email',
                       'type' => 'raw',
                       'value' => '$data->user->email',
                   ),
                   array(
                       'name' => 'sex',
                       'type' => 'raw',
                       'value' => '$data->user->sex',
                   ),
                   array(
                       'name' => 'P1',
                       'type' => 'raw',
                       'value' => '$data->user->radio->name',
                   ),

                   'id_music',
                   'date',
                   'time',
               ),
           ));
           /* $outputFile = 'test.csv';
            $cmd = Yii::app()->db->createCommand("SELECT t.id,u.name_listener,u.email,u.sex,r.name,t.id_music,t.date,t.time FROM Usertest as t,Users as u, radistations as r WHERE t.id_user=u.id_user and u.id_radiostation=r.id_radiostation");
            $csv = new ECSVExport($model->search());
            $csv->setOutputFile($outputFile);
            $csv->toCSV();

            Yii::app()->request->sendFile($outputFile, file_get_contents(Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $outputFile));
       */
        }

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    public function actionSongs($id)
    {
        $model = new MusicTestDetail('search');
        $model->unsetAttributes();
        $model->id_test = $id;

       // $model->sex=array(0,1);
        if($_GET['MusicTestDetail']['P1']==0){
            unset($_GET['MusicTestDetail']['P1']);
        }
        if($_GET['MusicTestDetail']['P2']==0){
            unset($_GET['MusicTestDetail']['P2']);
        }
        if (isset($_GET['MusicTestDetail']))

            $model->attributes = $_GET['MusicTestDetail'];

        if(!$model->sex){
            $model->sex=array(1,2);
        }


        if(!$model->id_education){

        $model->id_education=array_keys(EducationMult::all());
    }

        if (isset($_GET['file'])) {
            $this->widget('EExcelView', array(
                'id' => 'provider-problem-grid',
                'dataProvider' => $model->search(),
                'grid_mode' => 'export',
                'filename' => 'report',
                'filter' => $model,
                'title' => '',
                'autoWidth' => false,
                'stream' => true,
                'exportType' => $_GET['type'],
                'template' => "{items}\n{exportbuttons}\n{pager}",
                'columns' => array(

                    array(
                        'name' => 'song_name',
                        'type' => 'raw',
                        'value' => '$data->idSong->name',
                    ),
                    array(
                        'name' => 'positive',
                        'type' => 'raw',
                        'value' => '($data->getfavorite(5)*100/count($data))+
                        ($data->getfavorite(4)*100/count($data))+
                        ($data->getfavorite(3)*100/count($data))',
                    ),
                    array(
                        'name' => 'negative',
                        'type' => 'raw',
                        'value' => '($data->getfavorite(2)*100/count($data))+
                        ($data->getfavorite(1)*100/count($data))',
                    ),

                    array(
                        'name' => 'favorite',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(5)*100/count($data)',
                    ),
                    array(
                        'name' => 'like',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(4)*100/count($data)',
                    ),
                    array(
                        'name' => 'normal',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(3)*100/count($data)',
                    ),
                    array(
                        'name' => 'tired',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(2)*100/count($data)',
                    ),
                    array(
                        'name' => 'dislike',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(1)*100/count($data)',
                    ),
                    array(
                        'name' => 'never',
                        'type' => 'raw',
                        'value' => '$data->getnever()*100/count($data)',
                    ),
                    array(
                        'name' => 'positive_P1',
                        'type' => 'raw',
                        'value' => '($data->getfavorite(5,1)*100/count($data))+
                                    ($data->getfavorite(4,1)*100/count($data))+
                                    ($data->getfavorite(3,1)*100/count($data))+',
                    ),
                    array(
                        'name' => 'negative_P1',
                        'type' => 'raw',
                        'value' => '($data->getfavorite(2,1)*100/count($data)+
                                    ($data->getfavorite(1,1)*100/count($data))',
                    ),
                    array(
                        'name' => 'favorite_P1',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(5,1)*100/count($data)',
                    ),
                    array(
                        'name' => 'like_P1',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(4,1)*100/count($data)',
                    ),
                    array(
                        'name' => 'normal_P1',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(3,1)*100/count($data)',
                    ),
                    array(
                        'name' => 'tired_P1',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(2,1)*100/count($data)',
                    ),
                    array(
                        'name' => 'dislike_P1',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(1,1)*100/count($data)',
                    ),
                    array(
                        'name' => 'never_P1',
                        'type' => 'raw',
                        'value' => '$data->getnever(1)*100/count($data)',
                    ),
                    array(
                        'name' => 'positive_P2',
                        'type' => 'raw',
                        'value' => '($data->getfavorite(5,2)*100/count($data))+
                                    ($data->getfavorite(4,2)*100/count($data))+
                                    ($data->getfavorite(3,2)*100/count($data))',
                    ),
                    array(
                        'name' => 'negative_P2',
                        'type' => 'raw',
                        'value' => '($data->getfavorite(2,2)*100/count($data)+
                                    ($data->getfavorite(1,2)*100/count($data))',
                    ),
                    array(
                        'name' => 'favorite_P2',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(5,2)*100/count($data)',
                    ),
                    array(
                        'name' => 'like_P2',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(4,2)*100/count($data)',
                    ),
                    array(
                        'name' => 'normal_P2',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(3,2)*100/count($data)',
                    ),
                    array(
                        'name' => 'tired_P2',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(2,2)*100/count($data)',
                    ),
                    array(
                        'name' => 'dislike_P2',
                        'type' => 'raw',
                        'value' => '$data->getfavorite(1,2)*100/count($data)',
                    ),
                    array(
                        'name' => 'never_P2',
                        'type' => 'raw',
                        'value' => '$data->getnever(2)*100/count($data)',
                    ),
                )));

        }
        $this->render('songs', array('model' => $model));
    }
}