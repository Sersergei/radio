<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.02.2016
 * Time: 19:19
 */
class Item extends  CActiveRecord {
    public $image;
    // ?????? ????????

    public function rules(){
        return array(
            //????????????? ??????? ??? ?????, ??????????? ?????????
            // ?????? ????????!
            array('image', 'file', 'types'=>'jpg, gif, png'),
        );
    }
}