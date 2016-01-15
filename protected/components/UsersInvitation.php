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
    private $test;
    public function __construct(Users $user,$id_test=Null ){

        if($id_test){
            $this->test=Usertest::model()->find("id_user=".$user->id_user." and id_music=".$id_test);
        }
        else{
            $this->test=0;
        }
        if(!$this->test){
            $this->user=$user;
            $this->Email();
        }

    }
    private function Email(){
        if($this->filter()){
            $linc=md5(microtime().$this->user->name_listener.'rfvbgt');

           $this->user->link=$linc;

            $this->user->scenario ='update';
            $this->user->isNewRecord=false;

            if($this->user->saveAttributes(array ('link'))){

                $criteria = new CDbCriteria();
                $criteria->condition = 'id_radiostations = :id_radiostations';
                $criteria->params = array(':id_radiostations' => $this->user->id_radiostation);
                $settings=TestSettingsMult::model()->find($criteria);
                $text=$settings->invitation_text;


                $criteria = new CDbCriteria();
                $criteria->condition = 'id_radiostation = :id_radiostation';
                $criteria->params = array(':id_radiostation' => $this->user->id_radiostation);
                $radiosettings=RadiostationSettings::model()->find($criteria);


                $lang=Lang::model()->findByPk($radiosettings->id_lang);

                $hrefUnscribe=Yii::app()->getBaseUrl(true).'/register/DisActive/id/'.$this->user->id_user.'/linc/'.$this->user->activate.'?lang='.$lang->lang;
                $text_before='<br><br><br>'.'<a href ='.$hrefUnscribe.'>'.Yii::t('radio','Unscribe').'</a>';


                $href=Yii::app()->getBaseUrl(true).'/test/index/id/'.$this->user->id_user.'/linc/'.$linc.'?lang='.$lang->lang;
                $text=$text.'<br>'.Yii::t('radio','For beginning testing music you must click this ').'<a href ='.$href.'>'.Yii::t('radio','link').'</a>'.$text_before;
                $subject=$settings->invitation_topic;
                $email=$radiosettings->email;
                //$email=Yii::app()->params['adminEmail'];
                $headers="From: radio <{$email}>\r\n".
                    "Reply-To: {$email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-Type: text/html; charset=UTF-8 \r\n";

                mail($this->user->email,$subject,$text,$headers);
            }
            else var_dump($this->user->getErrors());

        }

    }
    private function Filter(){
        if($this->user->status)
            return false;

        $criteria = new CDbCriteria();
        $criteria->condition = 'id_radiostation = :id_radiostation AND id_type=:id_type AND id_status=:id_status';
        $criteria->params = array(':id_radiostation' => $this->user->id_radiostation,':id_status'=>2,':id_type'=>1);
        $musictest=MusicTest::model()->find($criteria);

        if(!$musictest)
            return false; //если нету то отправля ем falce

        $criteria = new CDbCriteria();
        $criteria->condition = 'id_radiostation = :id_radiostation';
        $criteria->params = array(':id_radiostation' => $this->user->id_radiostation);
        $testsettings=TestSettings::model()->find($criteria);

        if(($testsettings->sex )){//проверяем на пол
            if(!in_array($this->user->sex,$testsettings->sex))
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
            if(!in_array($this->user->id_education,$testsettings->id_education))
                return false;
        } // проверка на образование

        if($testsettings->week){ //проверка на дату последнего теста
            $date=60*60*24*7*$testsettings->week;
            $date=abs(time()-strtotime($date));
            $criteria = new CDbCriteria;
            $criteria->compare('id_user',$this->user->id_user);
            $criteria->limit='1';
            $criteria->order='date DESC';
            $usertest=Usertest::model()->find($criteria);

            if($usertest){
                if(strtotime($usertest->date)>$date)
                    return false;
            }

        }
        if($testsettings->count_from){ //прошел от  тестов
            $criteria = new CDbCriteria;
            $criteria->compare('id_user',$this->user->id_user);
            $usertest=Usertest::model()->count($criteria);
            if($usertest<$testsettings->count_from)
                return false;
        }
        if($testsettings->count_after){ //прошел до тестов
            $criteria = new CDbCriteria;
            $criteria->compare('id_user',$this->user->id_user);
            $usertest=Usertest::model()->count($criteria);
            if($usertest>$testsettings->count_after)
                return false;
        }

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