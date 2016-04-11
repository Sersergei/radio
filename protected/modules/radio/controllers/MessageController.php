<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 22.02.2016
 * Time: 15:32
 */
class MessageController extends Controller
{
    public function actionIndex($id=Null){
        if($id){
            $message=new Messages('search');

            if(isset($_GET['Messages']))
               $message->attributes=$_GET['MusicTest'];
                $message->id_test=$id;
            if(isset($_GET['users'])){
                $this->widget('EExcelView', array(
                    'id' => 'provider-problem-grid',
                    'dataProvider' => $message->search(),
                    'grid_mode' => 'export',
                    'filename' => 'message',
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
                            'filter'=>false,
                        ),
                        array(
                            'name' => 'email_fromm',
                            'type' => 'raw',
                            'value' => '$data->user->email',
                        ),


                        array(
                            'name' => 'date',
                            'type' => 'raw',
                            'value' => '$data->date',
                        ),

                        array(
                            'name' => 'message',
                            'type' => 'raw',
                            'value' => '$data->message',
                        ),

                    )));}

            $this->render('admin',array(
                'model'=>$message,
            ));

        }
        else{
            $this->render('message');
        }

    }
}