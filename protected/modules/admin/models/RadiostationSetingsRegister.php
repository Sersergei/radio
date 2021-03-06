<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 10.11.2015
 * Time: 11:31
 */
class RadiostationSetingsRegister extends CFormModel
{
    public $id_lang;
    public $not_use_music_marker;
    public $not_register_users;
    public $not_invite_users;
    public $id_card_registration;
    public $other_radiostations;
    public $email;
    public $never_test;
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_lang,email,other_radiostations', 'required'),
            array('id_lang, not_use_music_marker, not_register_users, not_invite_users, id_card_registration', 'numerical', 'integerOnly'=>true),
            array('other_radiostations', 'length', 'max'=>1000),
            array('test_song, mix_marker,email,never_test', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_lang, id_user, test_song, not_use_music_marker, not_register_users, not_invite_users, other_radiostations, id_card_registration', 'safe', 'on'=>'search'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'id_lang' => Yii::t('radio', 'Languge'),
            'test_song' => Yii::t('radio', 'Test Song'),
            'not_use_music_marker' => Yii::t('radio', 'Not use music marker'),
            'not_register_users' => Yii::t('radio', 'Not register if user doesn\'t choosed right music-maker'),
            'not_invite_users' => Yii::t('radio', ' Not invite for music test if user doesn\'t choosed right music-maker'),
            'id_radiostation' => Yii::t('radio', 'Id Radiostation'),
            'other_radiostations' => Yii::t('radio', 'Other Radiostations') ,
            'id_card_registration' => Yii::t('radio', 'Necessity ID card for registration') ,
            'email'=>Yii::t('radio','Your mail for subscribe'),
            'never_test'=>Yii::t('radio','unknown (without of next question)'),
        );
    }

}