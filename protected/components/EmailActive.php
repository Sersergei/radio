<?php

/**
 * Created by PhpStorm.
 * User: ������
 * Date: 28.12.2015
 * Time: 21:04
 */
class EmailActive
{
    public function __construct(Users $user){

        $this->user=$user;
        $app = Yii::app();
        $lang=$user->radio->radiostationSettings->idLang->lang;
        $this->lang=$lang;
        $app->setLanguage($lang);

        $this->email();

    }
    public function email(){
        $linc=md5(microtime().$this->user->name_listener.'rfvbgt');
        $this->user->activate=$linc;
        $this->user->scenario ='update';
        $this->user->isNewRecord=false;
        if($this->user->saveAttributes(array ('activate'))) {
            $href = Yii::app()->getBaseUrl(true) . '/register/active/id/' . $this->user->id_user . '/linc/' . $linc;

            $text = '<br><div style="font-family: Verdana"  ></div><strong>'.$this->user->name_listener.'</strong>,&nbsp; ' . Yii::t('radio', 'Thank you for your request to be added to the web Radio Music Test We add names to our list only after verifying the recipient`s permission, which is why we are sending you this address confirmation request To confirm that you would like to receive our future invite on the music tests, please ') . '<a href =' . $href .'>'.Yii::t('radio','click here.') . '</a>';
            $text=$text.'<br><br>'.Yii::t('radio','your name').': <strong>'.$this->user->name_listener.'</strong>';
            $text=$text.'<br>e-mail: <strong>'.$this->user->email.'</strong>';
            $text=$text.'<br>'.Yii::t('radio','your birth date').': <strong>'.$this->user->date_birth.'</strong>';
            $text=$text.'<br>'.Yii::t('radio','your sex').': <strong>'.$this->user->getsexuser().'</strong>';
            $text=$text.'<br>'.Yii::t('radio','your adress').': <strong>'.$this->user->getregion().'</strong>';
            //$text=$text.'<br>'.Yii::t('radio','yours education').': <strong>'.$this->user->education().'</strong>';


            $hrefUnscribe='http://radiomusictest.com/register/DisActive/id/'.$this->user->id_user.'/linc/'.$this->user->activate.'?lang='.$this->lang;
            $hrefUpdate='http://radiomusictest.com/register/Update/id/'.$this->user->id_user.'/linc/'.$this->user->activate.'?lang='.$this->lang;
            $text=$text.'<br><br><br>'.Yii::t('radio','If you wanna change settings your profile').'<a style="font-family: Verdana" href ='.$hrefUpdate.'>'.Yii::t('radio','click here').'</a><br><br><br><a style="font-family: Verdana" href ='.$hrefUnscribe.'>'.Yii::t('radio','Unscribe').'</a></div>';

            $subject = Yii::t('radio','Registration').'  '.$this->user->name_listener;
            //$email = Yii::app()->params['adminEmail'];
            $email=$this->user->radio->radiostationSettings->email;
            $headers = "From: radio <{$email}>\r\n" .
                "Reply-To: {$email}\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/html; charset=UTF-8 \r\n";
            //self::mailsend($this->user->email,'radiomusictestcom@gmail.com',$subject,$text);
            mail($this->user->email, $subject, $text, $headers);
        }
    }
    public  static function mailsend($to,$from,$subject,$message){
        $mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'Radiomusictest');
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        if(!$mail->Send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }

    }

}