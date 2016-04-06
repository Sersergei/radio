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
        $user=new Usertest('search');
        $user->unsetAttributes();
        $model->unsetAttributes();
        $model->id_test = $id;
        $user->id_music=$id;

       // $model->sex=array(0,1);
        $session = new CHttpSession;
        $session->open();

        if (isset($_GET['MusicTestDetail'])){
            $session['result']=$_GET['MusicTestDetail'];

        }
        if(isset($session['result']))
            $model->attributes = $session['result'];


        if(!$model->sex){
            $model->sex=array(1,2);
        }
        $user->sex=$model->sex;

        if(!$model->id_education){

        $model->id_education=array_keys(EducationMult::all());
    }
        if(!$model->region)
            $model->region=array_keys(TestSettings::getregion($model->idTest->id_radiostation));
        if(!$model->P1)
            $model->P1=array_keys(RadiostationSettings::getradiostation($model->idTest->id_radiostation));
        if($model->P2All){
            $model->P2=array_keys(RadiostationSettings::getradiostation($model->idTest->id_radiostation));
        }
        if(!$model->P2){
            $model->P2=array_keys(RadiostationSettings::getradiostation($model->idTest->id_radiostation));
            $model->P2All=1;
        }

        //$model->time=time($model->time);

        $user->age_from=$model->age_from;
        $user->after_age=$model->after_age;
        $user->time=$model->time;
        $user->region=$model->region;
        $user->education=$model->id_education;
        $user->P1=$model->P1;
        $user->P2=$model->P2;
        $user->P2All=$model->P2All;
        $user->marker=$model->marker;
        $user->P1P2=$model->P1P2;
        if (isset($_GET['file'])) {
            $iterator = new CDataProviderIterator($model->search());
//var_dump($iterator->coun5);
            $sumnever=0;
            $sumCoun1=0;
            $sumCoun2=0;
            $sumCoun3=0;
            $sumCoun4=0;
            $sumCoun5=0;
            $sumneverP1=0;
            $sumCounP11=0;
            $sumCounP12=0;
            $sumCounP13=0;
            $sumCounP14=0;
            $sumCounP15=0;
            $sumCoun=0;
            $sumCounP1=0;
            $sumneverP2=0;
            $sumCounP21=0;
            $sumCounP22=0;
            $sumCounP23=0;
            $sumCounP24=0;
            $sumCounP25=0;
            $sumCounP2=0;

            foreach ($iterator as $test){
                $sumCoun+=$test->Coun;
                $sumCoun1+=$test->Coun1;
                $sumCoun2+=$test->Coun2;
                $sumCoun3+=$test->Coun3;
                $sumCoun4+=$test->Coun4;
                $sumCoun5+=$test->Coun5;
                $sumnever+=$test->never;
                $sumCounP1+=$test->CounP1;
                $sumCounP11+=$test->CounP11;
                $sumCounP12+=$test->CounP12;
                $sumCounP13+=$test->CounP13;
                $sumCounP14+=$test->CounP14;
                $sumCounP15+=$test->CounP15;
                $sumneverP1+=$test->neverP1;
                $sumCounP2+=$test->CounP2;
                $sumCounP21+=$test->CounP21;
                $sumCounP22+=$test->CounP22;
                $sumCounP23+=$test->CounP23;
                $sumCounP24+=$test->CounP24;
                $sumCounP25+=$test->CounP25;
                $sumneverP2+=$test->neverP2;
            }
            if(!$sumCoun)
                $sumCoun=1;
            if(!$sumCounP1)
                $sumCounP1=1;
            if(!$sumCounP2)
                $sumCounP2=1;
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
                        ($data->Coun4*100/$data->Coun),2)',
                        'footer'=> round( (($sumCoun5+$sumCoun4+$sumCoun3)*100)/$sumCoun,2),
                    ),
                    array(
                        'name' => 'negative',
                        'type' => 'raw',
                        'value' => 'round(($data->Coun2*100/$data->Coun)+
                        ($data->Coun1*100/$data->Coun),2)',
                        'footer'=> round((($sumCoun1+$sumCoun2)*100)/$sumCoun,2),
                    ),

                    array(
                        'name' => 'favorite',
                        'type' => 'raw',
                        'value' => 'round($data->Coun5*100/$data->Coun,2)',
                        'footer'=> round((($sumCoun5*100)/$sumCoun),2),
                    ),
                    array(
                        'name' => 'like',
                        'type' => 'raw',
                        'value' => 'round($data->Coun4*100/$data->Coun,2)',
                        'footer'=> round($sumCoun4*100/$sumCoun,2),

                    ),
                    array(
                        'name' => 'normal',
                        'type' => 'raw',
                        'value' => 'round($data->Coun3*100/$data->Coun,2)',
                        'footer'=> round($sumCoun3*100/$sumCoun,2),
                    ),
                    array(
                        'name' => 'tired',
                        'type' => 'raw',
                        'value' => 'round($data->Coun2*100/$data->Coun,2)',
                        'footer'=>round( $sumCoun2*100/$sumCoun,2),
                    ),
                    array(
                        'name' => 'dislike',
                        'type' => 'raw',
                        'value' => 'round($data->Coun1*100/$data->Coun,2)',
                        'footer'=> round($sumCoun1*100/$sumCoun,2),
                    ),
                    array(
                        'name' => 'never',
                        'type' => 'raw',
                        'value' =>  'round($data->never*100/$data->Coun,2)',
                        'footer'=> round($sumnever*100/$sumCoun,2),
                    ),
                    array(
                        'name' => 'positive_P1',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP15*100/$data->CounP1)+
                        ($data->CounP14*100/$data->CounP1),2)',
                        'footer'=>round((($sumCounP15+$sumCounP14)*100/$sumCounP1),2),
                    ),
                    array(
                        'name' => 'negative_P1',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP12*100/$data->CounP1)+
                        ($data->CounP11*100/$data->CounP1),2)',
                        'footer'=>round((($sumCounP12+$sumCounP11)*100/$sumCounP1),2),
                    ),

                    array(
                        'name' => 'favorite_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP15*100/$data->CounP1,2)',
                        'footer'=>round($sumCounP15*100/$sumCounP1,2),
                    ),
                    array(
                        'name' => 'like_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP14*100/$data->CounP1,2)',
                        'footer'=>round($sumCounP14*100/$sumCounP1,2),
                    ),
                    array(
                        'name' => 'normal_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP13*100/$data->CounP1,2)',
                        'footer'=>round($sumCounP13*100/$sumCounP1,2),
                    ),
                    array(
                        'name' => 'tired_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP12*100/$data->CounP1,2)',
                        'footer'=>round($sumCounP12*100/$sumCounP1,2),
                    ),
                    array(
                        'name' => 'dislike_P1',
                        'type' => 'raw',
                        'value' => 'round($data->CounP11*100/$data->CounP1,2)',
                        'footer'=>round($sumCounP11*100/$sumCounP1,2),
                    ),
                    array(
                        'name' => 'never_P1',
                        'type' => 'raw',
                        'value' =>  'round($data->neverP1*100/$data->CounP1,2)',
                        'footer'=>round($sumneverP1*100/$sumCounP1,2),
                    ),
                    array(
                        'name' => 'positive_P2',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP25*100/$data->getCounP2())+
                        ($data->CounP24*100/$data->getCounP2()),2)',
                        'footer'=>round((($sumCounP25+$sumCounP24)*100)/$sumCounP2,2),
                        ),

                    array(
                        'name' => 'negative_P2',
                        'type' => 'raw',
                        'value' => 'round(($data->CounP22*100/$data->getCounP2())+
                        ($data->CounP21*100/$data->getCounP2()),2)',
                        'footer'=>round((($sumCounP21+$sumCounP22)*100)/$sumCounP2,2),
                    ),

                    array(
                        'name' => 'favorite_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP25*100/$data->getCounP2(),2)',
                        'footer'=>round($sumCounP25*100/$sumCounP2),
                    ),
                    array(
                        'name' => 'like_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP24*100/$data->getCounP2(),2)',
                        'footer'=>round($sumCounP24*100/$sumCounP2,2),
                    ),
                    array(
                        'name' => 'normal_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP23*100/$data->getCounP2(),2)',
                        'footer'=>round($sumCounP23*100/$sumCounP2,2),
                    ),
                    array(
                        'name' => 'tired_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP22*100/$data->getCounP2(),2)',
                        'footer'=>round($sumCounP22*100/$sumCounP2,2),
                    ),
                    array(
                        'name' => 'dislike_P2',
                        'type' => 'raw',
                        'value' => 'round($data->CounP21*100/$data->getCounP2(),2)',
                        'footer'=>round($sumCounP21*100/$sumCounP2,2),
                    ),
                    array(
                        'name' => 'never_P2',
                        'type' => 'raw',
                        'value' =>  'round($data->neverP2*100/$data->getCounP2(),2)',
                        'footer'=>round($sumneverP2*100/$sumCounP2,2),
                    ),

                )));

        }
        if(isset($_GET['users'])){
            $this->widget('EExcelView', array(
                'id' => 'provider-problem-grid',
                'dataProvider' => $user->search(),
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
                        'name' => 'Name',
                        'type' => 'raw',
                        'value' => '$data->user->name_listener',
                    ),
                    array(
                        'name' => 'Email',
                        'type' => 'raw',
                        'value' => '$data->user->email',
                    ),
                    array(
                        'name' => 'Sex',
                        'type' => 'raw',
                        'value' => '$data->user->getsex()',
                    ),
                    array(
                        'name' => 'education',
                        'type' => 'raw',
                        'value' => '$data->user->education()',
                    ),
                    array(
                        'name' => 'P1',
                        'type' => 'raw',
                        'value' => '$data->user->radio->radiostationSettings->getradio($data->user->P1)',
                    ),
                    array(
                        'name' => 'P2',
                        'type' => 'raw',
                        'value' => '$data->user->radio->radiostationSettings->getradio($data->user->P2)',

                    ),
                    array(
                        'name' => 'region',
                        'type' => 'raw',
                        'value' => '$data->user->getregion()',
                    ),
                    'time',

                ))
                );
        }
        if(isset($_GET['status'])){
            if($_GET['status']=='P1'){
                $this->render('songsP1', array('model' => $model));
            }
            else{
                $this->render('songsP2', array('model' => $model));
            }
        }
        else{
            $this->render('songs', array('model' => $model,'user'=>$user,));
        }
       // $this->render('songs', array('model' => $model,'user'=>$user,));
    }
    public function actionStatistic($id){
        $model = new Usertest('search');
        $model->id_music=$id;
        $statistic['count_all']=count($model->user());

        $model->sex=1;
        $statistic['count_all_man']=count($model->user());
        $model->sex=2;
        $statistic['count_all_woman']=count($model->user());

        $model->sex=Null;
        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=14;
        $model->age_from=1;
        $statistic['count_0_14']=count($model->user());


        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=19;
        $model->age_from=15;
        $statistic['count_15_19']=count($model->user());

        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=24;
        $model->age_from=20;
        $statistic['count_20_24']=count($model->user());

        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=29;
        $model->age_from=25;
        $statistic['count_25_29']=count($model->user());

        $model->sex=Null;
        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=34;
        $model->age_from=30;
        $statistic['count_30_34']=count($model->user());


        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=39;
        $model->age_from=35;
        $statistic['count_35_39']=count($model->user());

        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=44;
        $model->age_from=40;
        $statistic['count_40_44']=count($model->user());


        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=49;
        $model->age_from=45;
        $statistic['count_45_49']=count($model->user());

        $model->unsetAttributes();
        $model->id_music=$id;
        $model->after_age=100;
        $model->age_from=50;
        $statistic['count_50']=count($model->user());
        $model->after_age=Null;
        $model->age_from=Null;
        $statistic['educations']=EducationMult::all();
        $educations=array_keys($statistic['educations']);
        foreach($educations as $education){
            $model->education=$education;
            $statistic['education'][$education]=count($model->user());
        }



        $model->education=Null;
        $statistic['radiostations']=RadiostationSettings::getradiostation($model->test->id_radiostation);
        $radiostations=array_keys($statistic['radiostations']);
        foreach($radiostations as $radiostation){
            $model->P1=$radiostation;
            $statistic['P1'][$radiostation]=count($model->user());
        }

        $model->P1=Null;
        foreach($radiostations as $radiostation){
            $model->P2=$radiostation;
            $statistic['P2'][$radiostation]=count($model->user());
        }

        $model->P2=Null;
        $statistic['regions']=TestSettings::getregion($model->test->id_radiostation);
        $regions=array_keys($statistic['regions']);

        foreach($regions as $region){
            $model->region=$region;
            $statistic['region'][$region]=count($model->user());
        }


        $this->render('statistic', array('model' => $statistic));
    }

}