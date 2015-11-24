<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 20.11.2015
 * Time: 14:08
 */
class UsersInvitation
{
    private $user;
    public function __construct(Users $user ){
        $this->user=$user;
        $this->Email();
    }
    private function Email(){

        if($this->filter()){
            $linc=md5(microtime().$this->user->name_listener.'rfvbgt');
            $this->user->link=$linc;
            if($this->user->save()){
                $text=$this->user->radio->settings->invitation_text;
                $href=Yii::app()->getBaseUrl(true).'/test/index/id/'.$this->user->id_user.'/linc/'.$linc.'?lang='.$this->user->radio->lang->lang;
                $text=$text.'<br>Для прохождения тестирования перейдите по  <a href ='.$href.'> ссылке </a>';
                $subject=$this->user->radio->settings->invitation_topic;
                $email=Yii::app()->params['adminEmail'];
                $headers="From: radio <{$email}>\r\n".
                    "Reply-To: {$email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-Type: text/plain; charset=UTF-8";

                mail($this->user->email,$subject,$text,$headers);
            }

        }
    }
    private function Filter(){
        $setings=$this->user->radio->MusicTest;
        $test=false;
        foreach($setings as $tests){ //роверка есть ли щас активный тест со типом call-out
            if(($tests->id_type==1) and ($tests->id_status==2))
                $test=true;
        }

        if(!$test)
            return false; //если нету то отправля ем falce
        $testsettings=$this->user->radio->testsettings;
        if(($testsettings->sex )){//проверяем на пол
            if($testsettings->sex!==$this->user->sex)
                return false;
        }


        if(!$testsettings->age_from)
            $age_from=14;
        else
            $age_from=$testsettings->age_from;


        if(! $testsettings->after_age)
            $after_age=65;
        else
            $after_age=$testsettings->after_age;

        if(!($age_from< $this->yer() and $this->yer() <$after_age) ) //проверка на возраст
            return false;

        if($testsettings->id_education){
            if($testsettings->id_education!==$this->user->id_education)
                return false;
        } // проверка на образование

        if($testsettings->Invitations==0)
            return true;
        if($testsettings->Invitations==1){
            if(($this->user->id_radiostation==$this->user->P1 or $this->user->id_radiostation==$this->user->P2)and $this->user->mix_marker='+')
                return true;
            else return false;
        }
        if($testsettings->Invitations==2){
            if(($this->user->id_radiostation==$this->user->P1)and $this->user->mix_marker=='+')
                return true;
            else return false;
        }
        if($testsettings->Invitations==3){
            if($this->user->mix_marker=='+')
                return true;
            else return false;
        }
    }
    private function yer(){
        $diff = abs(time()-strtotime($this->user->date_birth));
        $years = floor($diff / (365*60*60*24));
        return $years;
    }

}