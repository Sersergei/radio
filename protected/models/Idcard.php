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



        );
    }
    public function attributeLabels()
    {
        return array(
            'card' => Yii::t('radio','ID-card '),

        );
    }
    public function idcards($attribute){
        $i=substr($this->card, -1);
        $num=substr($this->card, 0, -1);
        $summ=$this->summ($num);

        if($summ!=$i)
            $this->addError($attribute,Yii::t('radio','Карта не действительна'));

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