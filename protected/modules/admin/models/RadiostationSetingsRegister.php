<?php

/**
 * Created by PhpStorm.
 * User: ������
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
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_lang', 'required'),
            array('id_lang, not_use_music_marker, not_register_users, not_invite_users, id_card_registration', 'numerical', 'integerOnly'=>true),
            array('other_radiostations', 'length', 'max'=>1000),
            array('test_song, mix_marker', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_lang, id_user, test_song, not_use_music_marker, not_register_users, not_invite_users, other_radiostations, id_card_registration', 'safe', 'on'=>'search'),
        );
    }
    public function attributeNames()
    {
        return array(
            'id_lang' => Yii::t('radio', 'Languge'),
            'test_song' => Yii::t('radio', 'Test Song'),
            'not_use_music_marker' => Yii::t('radio', ' ����������� ������ ��� ����������� ���������� ���� ������������ �� �����'),
            'not_register_users' => Yii::t('radio', '�� �������������� ���������� � ����������������� ����������� ��������'),
            'not_invite_users' => Yii::t('radio', ' �� ���������� �������������, ������� �� ������ ������������ ����������� ��������'),
            'id_radiostation' => Yii::t('radio', 'Id Radiostation'),
            'other_radiostations' => Yii::t('radio', 'Other Radiostations') ,
            'id_card_registration' => Yii::t('radio', 'Id Card Registration') ,
        );
    }

}