<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 17.11.2015
 * Time: 22:02
 */
class Mix extends CFormModel
{
    public $mixmarker;
    public function rules()
    {
        return array(
            array('mixmarker', 'required'),
            array('mixmarker', 'safe'),


        );
    }

}