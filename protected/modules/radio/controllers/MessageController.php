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

            $this->render('admin',array(
                'model'=>$message,
            ));

        }
        else{
            $this->render('message');
        }

    }
}