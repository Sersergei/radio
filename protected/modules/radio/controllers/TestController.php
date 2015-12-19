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

        if (isset($_GET['MusicTestDetail'])){

            $model->attributes = $_GET['MusicTestDetail'];
        }



        if(!$model->sex){
            $model->sex=array(1,2);
        }


        if(!$model->id_education){

        $model->id_education=array_keys(EducationMult::all());
    }
        if(!$model->P1)
            $model->P1=array_keys(RadiostationSettings::getradiostation($model->idTest->id_radiostation));
        if(!$model->P2)
            $model->P2=array_keys(RadiostationSettings::getradiostation($model->idTest->id_radiostation));

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
                        'value' => 'round(($data->Coun5*100/$data->Coun)+
                        ($data->Coun4*100/$data->Coun)+
                        ($data->Coun3*100/$data->Coun),2)',
                    ),
                    array(
                        'name' => 'negative',
                        'type' => 'raw',
                        'value' => 'round(($data->Coun2*100/$data->Coun)+
                        ($data->Coun1*100/$data->Coun),2)',
                    ),

                    array(
                        'name' => 'favorite',
                        'type' => 'raw',
                        'value' => 'round($data->Coun5*100/$data->Coun,2)',
                    ),
                    array(
                        'name' => 'like',
                        'type' => 'raw',
                        'value' => 'round($data->Coun4*100/$data->Coun,2)',
                    ),
                    array(
                        'name' => 'normal',
                        'type' => 'raw',
                        'value' => 'round($data->Coun3*100/$data->Coun,2)',
                    ),
                    array(
                        'name' => 'tired',
                        'type' => 'raw',
                        'value' => 'round($data->Coun2*100/$data->Coun,2)',
                    ),
                    array(
                        'name' => 'dislike',
                        'type' => 'raw',
                        'value' => 'round($data->Coun1*100/$data->Coun,2)',
                    ),
                    array(
                        'name' => 'never',
                        'type' => 'raw',
                        'value' =>  'round($data->never*100/$data->Coun,2)',
                    ),
                    array(
                        'name' => 'positive_P1',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP15*100/$data->CounP1)+
                        ($data->CounP14*100/$data->CounP1)+
                        ($data->CounP13*100/$data->CounP1),2)',
                    ),
                    array(
                        'name' => 'negative_P1',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP12*100/$data->CounP1)+
                        ($data->CounP11*100/$data->CounP1),2)',
                    ),

                    array(
                        'name' => 'favorite_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP15*100/$data->CounP1,2)',
                    ),
                    array(
                        'name' => 'like_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP14*100/$data->CounP1,2)',
                    ),
                    array(
                        'name' => 'normal_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP13*100/$data->CounP1,2)',
                    ),
                    array(
                        'name' => 'tired_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP12*100/$data->CounP1,2)',
                    ),
                    array(
                        'name' => 'dislike_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP11*100/$data->CounP1,2)',
                    ),
                    array(
                        'name' => 'never_P1',
                        'type' => 'raw',
                        'value' =>  'round($data->neverP1*100/$data->CounP1,2)',
                    ),
                    array(
                        'name' => 'positive_P2',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP25*100/$data->getCounP2()+
                        ($data->CounP24*100/$data->getCounP2()+
                        ($data->CounP23*100/$data->CounP2),2)',
                    ),
                    array(
                        'name' => 'negative_P2',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP22*100/$data->getCounP2())+
                        ($data->CounP21*100/$data->getCounP2()),2)',
                    ),

                    array(
                        'name' => 'favorite_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP25*100/$data->getCounP2(),2)',
                    ),
                    array(
                        'name' => 'like_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP24*100/$data->getCounP2(),2)',
                    ),
                    array(
                        'name' => 'normal_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP23*100/$data->getCounP2(),2)',
                    ),
                    array(
                        'name' => 'tired_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP22*100/$data->getCounP2(),2)',
                    ),
                    array(
                        'name' => 'dislike_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP21*100/$data->getCounP2(),2)',
                    ),
                    array(
                        'name' => 'never_P2',
                        'type' => 'raw',
                        'value' =>  'round($data->neverP2*100/$data->getCounP2(),2)',
                    ),

                )));

        }
        if(isset($_GET['status'])){
            if($_GET['status']=='P1'){
                $this->render('songsP1', array('model' => $model));
            }
            else{
                $this->render('songsP2', array('model' => $model));
            }
        }
        else
        $this->render('songs', array('model' => $model));
    }
}