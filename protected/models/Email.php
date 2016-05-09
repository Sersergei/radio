<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.05.2016
 * Time: 9:15
 */
class Email extends CFormModel
{
    public $email;
    public function rules()
    {
        return array(
            array('email','email'),
            array('email', 'required'),
        );
    }


}