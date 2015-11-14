<?php

/**
 * This is the model class for table "test_settings".
 *
 * The followings are the available columns in table 'test_settings':
 * @property integer $id_test_settings
 * @property integer $id_radiostation
 * @property integer $sex
 * @property integer $age_from
 * @property integer $after_age
 * @property integer $id_education
 * @property integer $Invitations
 *
 * The followings are the available model relations:
 * @property RadiostationSettings $idRadiostation
 * @property EducationMult $idEducation
 */
class TestSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Invitations', 'required'),
			array('id_radiostation, sex, age_from, after_age, id_education, Invitations', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test_settings, id_radiostation, sex, age_from, after_age, id_education, Invitations', 'safe', 'on'=>'search'),
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
			'idRadiostation' => array(self::BELONGS_TO, 'RadiostationSettings', 'id_radiostation'),
			'idEducation' => array(self::BELONGS_TO, 'EducationMult', 'id_education'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_test_settings' =>Yii::t('radio', 'Id Test Settings') ,
			'id_radiostation' =>Yii::t('radio', 'Id Radiostation') ,
			'sex' => Yii::t('radio', 'Sex'),
			'age_from' =>Yii::t('radio', 'Age From') ,
			'after_age' =>Yii::t('radio', 'After Age') ,
			'id_education' =>Yii::t('radio', 'Id Education') ,
			'Invitations' =>Yii::t('radio', 'Invitations') ,
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

		$criteria->compare('id_test_settings',$this->id_test_settings);
		$criteria->compare('id_radiostation',$this->id_radiostation);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('age_from',$this->age_from);
		$criteria->compare('after_age',$this->after_age);
		$criteria->compare('id_education',$this->id_education);
		$criteria->compare('Invitations',$this->Invitations);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestSettings the static model class
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
			$this->id_radiostation=$user->id_radiostation;

		}
		parent::beforeSave();
		return true;
	}
}
