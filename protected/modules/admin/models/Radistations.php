<?php

/**
 * This is the model class for table "radistations".
 *
 * The followings are the available columns in table 'radistations':
 * @property integer $id_radiostation
 * @property string $name
 * @property string $location
 * @property integer $all_tests
 * @property string $date_add
 * @property integer $status
 * @property integer $songs
 *
 * The followings are the available model relations:
 * @property RadiostationSettings[] $radiostationSettings
 * @property Users[] $users
 * @property Users[] $users1
 * @property UsersHst[] $usersHsts
 */
class Radistations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'radistations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('all_tests, status, songs', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
			array('location', 'length', 'max'=>255),
			array('date_add', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_radiostation, name, location, all_tests, date_add, status, songs', 'safe', 'on'=>'search'),
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
			'radiostationSettings' => array(self::HAS_MANY, 'RadiostationSettings', 'id_radiostation'),
			'users' => array(self::HAS_MANY, 'Users', 'id_radiostation'),
			'users1' => array(self::HAS_MANY, 'Users', 'P1'),
			'usersHsts' => array(self::HAS_MANY, 'UsersHst', 'id_radiostation'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_radiostation' => 'Id Radiostation',
			'name' => 'Name',
			'location' => 'Location',
			'all_tests' => 'All Tests',
			'date_add' => 'Date Add',
			'status' => 'Status',
			'songs' => 'Songs',
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

		$criteria->compare('id_radiostation',$this->id_radiostation);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('all_tests',$this->all_tests);
		$criteria->compare('date_add',$this->date_add,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('songs',$this->songs);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Radistations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
