<?php

/**
 * Created by PhpStorm.
 * User: ������
 * Date: 10.11.2015
 * Time: 23:30
 */
class loadmix extends CActiveRecord
{
public $file;
    public $limit;
    public function __construct($limit=0){
        $this->limit=$limit;
    }
    public function rules(){
        var_dump($this->limit);
        return array(
        array('file', 'file', 'types'=>'mp3','maxFiles'=>(1* $this->limit)),
        );
    }
}