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
            $text='<br><strong>'.Yii::t('radio','Your Name').': </strong>'.$this->user->name_listener;
            $text=$text.'<br><strong> Email : </strong>'.$this->user->email;
            $text=$text.'<br><strong>'.Yii::t('radio','Birth Date').': </strong>'.$this->user->date_birth;
            $text=$text.'<br><strong>'.Yii::t('radio','Sex').': </strong>'.$this->user->getsexuser();
            $text=$text.'<br><strong>'.Yii::t('radio','Where are you from?').': </strong>'.$this->user->getregion();
            $text=$text.'<br><strong>'.Yii::t('radio','What education do you have?').': </strong>'.$this->user->education();
            $text=$text.'<br><strong>'.Yii::t('radio','What radiostation are you listen more than other on last week?').': </strong>'.$this->user->radio->radiostationSettings->getradio($this->user->P1);
            $text=$text.'<br><strong>'.Yii::t('radio','What other radiostations are you listen yet on last week?').': </strong>'.$this->user->radio->radiostationSettings->getradio($this->user->P2);
            $text = $text.'<br><br><br><strong>'.$this->user->name_listener.'</strong>,&nbsp; ' . Yii::t('radio', 'Thank you for your request to be added to the web Radio Music Test We add names to our list only after verifying the recipient`s permission, which is why we are sending you this address confirmation request To confirm that you would like to receive our future invite on the music tests, please ') . '<a href =' . $href .'>'.Yii::t('radio','click here.') . '</a>';
            $subject = Yii::t('radio','Registration').'  '.$this->user->name_listener;
            //$email = Yii::app()->params['adminEmail'];
            $email=$this->user->radio->radiostationSettings->email;
            $headers = "From: radio <{$email}>\r\n" .
                "Reply-To: {$email}\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-Type: text/html; charset=UTF-8 \r\n";
            self::mailsend($this->user->email,'radiomusictestcom@gmail.com',$subject,$text);
           // mail($this->user->email, $subject, $text, $headers);
        }
    }
    public  static function mailsend($to,$from,$subject,$message){
        $mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'Radiomusictest');
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

}