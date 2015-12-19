<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 10.11.2015
 * Time: 20:44
 */
class RadiostationSetingsBedmixmarker extends CFormModel
{
    public $id;
    public $mixmarker;
    public $limit;
    public $file;
    public function __construct($limit=0){
        $this->limit=$limit;
    }
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mixmarker','max_array','on'=>'before,beforegod,aftergood'),
            array('mixmarker','repeat','on'=>'beforegod,aftergood'),
            array('mixmarker','min_array','on'=>'after'),
            array('mixmarker','required','on'=>'aftergood,after'),
            array('file', 'file', 'types'=>'mp3','maxFiles'=>($this->limit-count($this->mixmarker)),'allowEmpty' => TRUE),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('mixmarker,file', 'safe'),
        );
    }
    public function max_array($attribute){

    if (count($this->mixmarker)>$this->limit)
        $this->addError($attribute,'выберите не больше'.$this->limit.' миксмаркеров');

}
    public function min_array($attribute){

        if (count($this->mixmarker)<$this->limit)
            $this->addError($attribute,'выберите не меньше'.$this->limit.' миксмаркеров');

    }
    public function repeat($attribute){
        $session=new CHttpSession;
        $session->open();
        if($session['bed_mixmarker']){
           $bed=unserialize($session['bed_mixmarker']);

        }
        elseif($session['god_mixmarker']){

            $bed=unserialize($session['god_mixmarker']);
        }
        elseif($session['my_mixmarker']){
            $bed[]=$session['my_mixmarker'];
        }

        if(isset($bed)){
            $bed[]=0;
            if($this->mixmarker)

                foreach($this->mixmarker as $mix){

                    if(in_array($mix,$bed)){
                        $this->addError($attribute,Yii::t('radio','Вы выбрали такойже миксмаркр вернитесь назад и
                     переопределите  миксмаркер либо выберети другой '));
                        break;
                    }
                }
        }

    }

}