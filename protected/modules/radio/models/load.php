<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.01.2016
 * Time: 17:25
 */
class load extends CFormModel
{
    public $document;
    public function rules() {
        return array(
            array('document', 'required'),
            array('document','file','types'=>'xls,xlsx'),
        );
    }

    public function attributeLabels() {
        return array(
            'document' => 'Документ',
        );
    }

}