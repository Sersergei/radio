<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 10.11.2015
 * Time: 20:44
 */
class RadiostationSetingsBedmixmarker extends CFormModel
{
    public $mixmarker;
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mixmarker','max_array'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('mixmarker', 'safe', 'on'=>'search'),
        );
    }
    public function max_array($attribute){

        if (count($this->mixmarker)>4)
            $this->addError($attribute,'выберите не больше 4-х миксмаркеров');

    }

}