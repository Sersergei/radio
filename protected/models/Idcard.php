<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 18.12.2015
 * Time: 15:13
 */
class Idcard extends CFormModel
{
    public $card;
    public function rules()
    {
        return array(
            array('card', 'numerical', 'integerOnly'=>true),
            array('card', 'required'),

            array('card','length','max'=>11,'min'=>11),
            array('card','idcards'),



        );
    }
    public function attributeLabels()
    {
        return array(
            'card' => Yii::t('radio','ID-card '),

        );
    }
    public function idcards($attribute){
        $ik=$this->card;
        $z=Null;
        if (!preg_match("'^\d{11}$'",$ik)){ //Kontrollime, et kõik oleks numbrid ja kood õige pikkusega
          $z= "VIGA: Isikukood on vigane!";
        }
//Arvutame kontrollsumma (2 erinevat varianti korraga,
// 1 neist valitakse vastavalt summa väärtusele hiljem)
        $s1=$s2=0; //mõlemad summad alguses 0-ga võrdseks!
        $k1=1; //
        $k2=3;
        for ($i=0; $i<strlen($ik)-1; $i++){
            $s1+=$ik[$i]*$k1;
            $s2+=$ik[$i]*$k2;
            $k1=($k1==9)?1:$k1+1;
            $k2=($k2==9)?1:$k2+1;
        }
        if (($s1%11)<10){
            $kontrollsumma=$s1%11;
        }elseif (($s2%11)<10){
            $kontrollsumma=$s2%11;
        }else{
            $kontrollsumma=0;
        }

        $abi=unpack("a1sugu/a2aasta/a2kuu/a2paev/a3jrk/a1chk",$ik); //Tükeldame iskukoodi osadeks
//var_dump($abi);
//Kas kontrollsumma on OK
        if ($abi['chk']!=$kontrollsumma) {
            $z="VIGA: Isikukood on vigane!";
        }

//Leiame iskikukoodis oleva info
       $info['sugu']=($abi['sugu']%2)?"M":"N"; //sugu
        $info['aasta']=(17+(int)(($abi['sugu']+1)/2)).$abi['aasta']; //Sünniaasta 4-kohalisena
        $info['kuu']=(int)$abi['kuu']; //sünnikuu
        $info['päev']=(int)$abi['paev']; //sünnikuupäev

                $pkpv=unpack("a4A/a2K/a2P", date("Ymd") ); //Praegune kuupäev

                $kuu=array(0,31,28+($abi['aasta']%4?0:1 )-($abi['aasta']%400?0:1),31,30,31,30,31,31,30,31,30,31); //Kuude pikkused sünniaastal
                $pkuu=array(0,31,28+($pkpv['A']%4?0:1)- ($pkpv['A']%400?0:1),31,30,31,30,31,31,30,31,30,31); //Kuude pikkused sel aastal

        //Arvutame vanuse
        $info['vanus_kuu']=($pkpv['K']>$info['kuu']?$pkpv['K']-$info['kuu']:12-($info['kuu']-$pkpv['K']))-($pkpv['P']<$info['päev']);
        $info['vanus_kuu']=$info['vanus_kuu']==12?0:$info['vanus_kuu'];
        $eelkuu=$pkpv['K']-1;
        $eelkuu=$eelkuu<1?12:$eelkuu;
        $info['vanus_päev']=($pkpv['P']>$info['päev'])?$pkpv['P']-$info['päev']:$pkuu[$eelkuu]-($info['päev']-$pkpv['P']);
        $info['vanus_päev']=$info['vanus_päev']>=$pkuu[$eelkuu]?0:$info['vanus_päev'];

                //Kontrollime vanust
                if ($info['vanus_päev']<0){
                    $z="VIGA: Isikukood on vigane!";
                }
                //Viimane kontroll veel kuupäevale, enne õige tulemuse tagastamist
                if ((!$info['kuu'] || $info['kuu']>12) || (!$info['päev'] || $info['päev']>$kuu[$info['kuu']])){
                //Kontrollime ainult, et kuupäev ei ületaks 31-e ja kuu 12-e!
                    $z="VIGA: Isikukood on vigane!";
                }

//var_dump($info);  //Kui kõik oli korras, tagastame tulemuse

        if($z)
            $this->addError($attribute,Yii::t('radio','VIGA: Isikukood on vigane!'));

    }
    public function summ($number){
        for($i = 0, $ds = 0; $i < strlen($number); $i++) $ds += $number[$i];

        if (iconv_strlen($ds)>1){

            return $this->summ("$ds");

        }
        else{
            return $ds;
        }

    }

}