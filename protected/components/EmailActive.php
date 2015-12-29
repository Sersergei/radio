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
            $text =  '<br>' . Yii::t('radio', 'Thank you for your request to be added to the web radiomusictest.com We add names to our list only after verifying the recipient`s permission, which is why we are sending you this address confirmation request To confirm that you would like to receive our future invite on the music tests, please ') . '<a href =' . $href . '> ' . Yii::t('radio', 'click here.') . '</a>';
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