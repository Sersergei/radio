<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 10.11.2015
 * Time: 23:30
 */
class loadmix extends CActiveRecord
{
public $file;
    public function role(){
        return array(
        array('file', 'file', 'types'=>'mp3'),
        );
    }
}