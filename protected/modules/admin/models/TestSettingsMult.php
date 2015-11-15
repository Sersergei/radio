<?php

/**
 * This is the model class for table "test_settings_mult".
 *
 * The followings are the available columns in table 'test_settings_mult':
 * @property integer $id_test_mult
 * @property integer $id_radiostations
 * @property string $text_before_test
 * @property string $text_after_test
 * @property string $invitation_topic
 * @property string $invitation_text
 * @property integer $test_song
 *
 * The followings are the available model relations:
 * @property RadiostationSettings $idRadiostations
 */
class TestSettingsMult extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test_settings_mult';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('test_song,text_before_test, text_after_test, invitation_topic, invitation_text', 'required'),
			array('id_radiostations, test_song', 'numerical', 'integerOnly'=>true),
			array('text_before_test, text_after_test, invitation_topic, invitation_text', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test_mult, id_radiostations, text_before_test, text_after_test, invitation_topic, invitation_text, test_song', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'idRadiostations' => array(self::HAS_ONE, 'Radiostations', 'id_radiostations'),
			'radiostation' => array(self::HAS_MANY, 'RadiotationSettings', 'id_radiostations'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_test_mult' =>Yii::t('radio', 'Id Test Mult') ,
			'id_radiostations' =>Yii::t('radio', 'Id Radiostations') ,
			'text_before_test' =>Yii::t('radio', 'Text Before Test') ,
			'text_after_test' =>Yii::t('radio', 'Text After Test') ,
			'invitation_topic' =>Yii::t('radio', 'Invitation Topic') ,
			'invitation_text' =>Yii::t('radio', 'Invitation Text') ,
			'test_song' =>Yii::t('radio', 'Test Song') ,
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_test_mult',$this->id_test_mult);
		$criteria->compare('id_radiostations',$this->id_radiostations);
		$criteria->compare('text_before_test',$this->text_before_test,true);
		$criteria->compare('text_after_test',$this->text_after_test,true);
		$criteria->compare('invitation_topic',$this->invitation_topic,true);
		$criteria->compare('invitation_text',$this->invitation_text,true);
		$criteria->compare('test_song',$this->test_song);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestSettingsMult the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	protected function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
			$this->id_radiostations=$user->id_radiostation;

		}
		parent::beforeSave();
		return true;
	}
}
