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
            
        }
    }
    private function Filter(){
        $setings=$this->user->radio->MusicTest;
        $test=falce;
        foreach($setings as $tests){ //роверка есть ли щас активный тест со типом call-out
            if(($tests->id_type==1) and ($tests->id_status==2))
                $test=true;
        }
        if(!$test)
            return falce; //если нету то отправля ем falce
        $testsettings=$this->user->radio->testsettings;
        if(!($testsettings->sex and $testsettings->sex==$this->user->sex)) //проверяем на пол
            return false;
        if(!$testsettings->age_from)
            $age_from=14;
        else
            $age_from=$testsettings->age_from;


        if(! $testsettings->after_age)
            $after_age=65;
        else
            $after_age=$testsettings->after_age;
        if(!($age_from<=$this->yer() and $this->yer() <=$after_age) ) //проверка на возраст
            return falce;
        if(!($testsettings->id_education and $testsettings->id_education==$this->user->id_education)) // проверка на образование
            return false;
        if($testsettings->Invitations==1)
            return true;
        if($testsettings->Invitations==2){
            if(($this->user->id_radiostation==$this->user->P1 or $this->user->id_radiostation==$this->user->P2)and $this->user->mix_marker='+')
                return true;
            else return false;
        }
        if($testsettings->Invitations==3){
            if(($this->user->id_radiostation==$this->user->P1)and $this->user->mix_marker=='+')
                return true;
            else return false;
        }
        if($testsettings->Invitations==4){
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