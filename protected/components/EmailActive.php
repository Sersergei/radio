<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 28.12.2015
 * Time: 21:04
 */
class EmailActive
{
    public function __construct(Users $user){

        $this->user=$user;
        $app = Yii::app();
        $lang=$user->radio->radiostationSettings->idLang->lang;
        $app->setLanguage($lang);
        $this->email();
    }
    public function email(){
        $linc=md5(microtime().$this->user->name_listener.'rfvbgt');
        $this->user->link=$linc;
        $this->user->scenario ='update';
        $this->user->isNewRecord=false;
        if($this->user->saveAttributes(array ('link'))) {
            $href = Yii::app()->getBaseUrl(true) . '/register/active/id/' . $this->user->id_user . '/linc/' . $linc;
            $text =  '<br>' . Yii::t('radio', 'To confirm registration click on the ') . '<a href =' . $href . '> ' . Yii::t('radio', 'link') . '</a>';
            $subject = Yii::t('radio','Registration');
            $email = Yii::app()->params['adminEmail'];
            $headers = "From: radio <{$email}>\r\n" .
                "Reply-To: {$email}\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/html; charset=UTF-8 \r\n";

            mail($this->user->email, $subject, $text, $headers);
        }
    }

}