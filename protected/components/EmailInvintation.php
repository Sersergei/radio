<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 25.01.2016
 * Time: 16:47
 */
class EmailInvintation
{
    public function Email(Users $user){
            $linc=md5(microtime().$user->name_listener.'rfvbgt');

            $user->link=$linc;

            $user->scenario ='update';
            $user->isNewRecord=false;

            if($user->saveAttributes(array ('link'))){

                $criteria = new CDbCriteria();
                $criteria->condition = 'id_radiostations = :id_radiostations';
                $criteria->params = array(':id_radiostations' => $user->id_radiostation);
                $settings=TestSettingsMult::model()->find($criteria);
                $text=$settings->invitation_text;


                $criteria = new CDbCriteria();
                $criteria->condition = 'id_radiostation = :id_radiostation';
                $criteria->params = array(':id_radiostation' => $user->id_radiostation);
                $radiosettings=RadiostationSettings::model()->find($criteria);


                $lang=Lang::model()->findByPk($radiosettings->id_lang);
                $app = Yii::app();
                $app->setLanguage($lang->lang);

                $hrefUnscribe=Yii::app()->getBaseUrl(true).'/register/DisActive/id/'.$user->id_user.'/linc/'.$user->activate.'?lang='.$lang->lang;
                $text_before='<br><br><br>'.'<a href ='.$hrefUnscribe.'>'.Yii::t('radio','Unscribe').'</a>';


                $href=Yii::app()->getBaseUrl(true).'/register/update/id/'.$user->id_user.'/linc/'.$linc.'?lang='.$lang->lang;
                $text=$text.'<br>'.Yii::t('radio','For beginning testing music you must click this ').'<a href ='.$href.'>'.Yii::t('radio','link').'</a>'.$text_before;
                $subject=$settings->invitation_topic;
                $email=$radiosettings->email;
                //$email=Yii::app()->params['adminEmail'];
                $headers="From: radio <{$email}>\r\n".
                    "Reply-To: {$email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-Type: text/html; charset=UTF-8 \r\n";

                mail($user->email,$subject,$text,$headers);
            }


        }

}