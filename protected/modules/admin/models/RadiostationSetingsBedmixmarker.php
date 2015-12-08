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
            array('mixmarker','max_array','on'=>'before,beforegod'),
            array('mixmarker','repeat','on'=>'beforegod'),
            array('mixmarker','min_array','on'=>'after'),
            array('mixmarker','required','on'=>'after'),
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

        if (count($this->mixmarker)<$this->limit and !$this->mixmarker)
            $this->addError($attribute,'выберите не меньше'.$this->limit.' миксмаркеров');

    }
    public function repeat($attribute){
        $session=new CHttpSession;
        $session->open();
        if(isset($session['bed_mixmarker'])){
            $bed=unserialize($session['bed_mixmarker']);

        }
        elseif(isset($session['god_mixmarker'])){
            $bed=unserialize($session['god_mixmarker']);

        }
        elseif($session['my_mixmarker']){
            $bed=$session['my_mixmarker'];
        }
        else{
            $settings=RadiostationSettings::model()->findByPk($this->id);
            $bed=unserialize($settings->bed_mixmarker);
        }

        if($this->mixmarker)
        foreach($this->mixmarker as $mix){

            if(in_array($mix,$bed)){
                $this->addError($attribute,'Вы выбрали такойже миксмарке в неподходящих маркерах вернитесь назад и
                     переопределите неподходящий миксмаркер либо выберети другой подходящий');
            }
        }
    }

}