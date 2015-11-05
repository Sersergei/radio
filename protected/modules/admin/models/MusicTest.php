<?php

/**
 * This is the model class for table "music_test".
 *
 * The followings are the available columns in table 'music_test':
 * @property integer $id_test
 * @property integer $id_radiostation
 * @property integer $id_type
 * @property string $date_add
 * @property string $date_started
 * @property integer $id_control
 * @property integer $max_listeners
 * @property integer $test_number
 * @property string $date_finished
 */
class MusicTest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'music_test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_test, id_radiostation, id_type, date_add, date_started, id_control, test_number, date_finished', 'required'),
			array('id_test, id_radiostation, id_type, id_control, max_listeners, test_number', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test, id_radiostation, id_type, date_add, date_started, id_control, max_listeners, test_number, date_finished', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_test' => 'Id Test',
			'id_radiostation' => 'Id Radiostation',
			'id_type' => 'Id Type',
			'date_add' => 'Date Add',
			'date_started' => 'Date Started',
			'id_control' => 'Id Control',
			'max_listeners' => 'Max Listeners',
			'test_number' => 'Test Number',
			'date_finished' => 'Date Finished',
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

		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('id_radiostation',$this->id_radiostation);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('date_add',$this->date_add,true);
		$criteria->compare('date_started',$this->date_started,true);
		$criteria->compare('id_control',$this->id_control);
		$criteria->compare('max_listeners',$this->max_listeners);
		$criteria->compare('test_number',$this->test_number);
		$criteria->compare('date_finished',$this->date_finished,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MusicTest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
