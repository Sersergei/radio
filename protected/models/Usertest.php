<?php

/**
 * This is the model class for table "Usertest".
 *
 * The followings are the available columns in table 'Usertest':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_music
 * @property string $date
 * @property string $time
 */
class Usertest extends CActiveRecord
{
	public $email;
	public $sex;
	public $P1;
	public $P2;
	public $education;
	public $region;
	public $age_from;
	public $after_age;
	public $P2All;
	public $marker;
	public $P1P2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Usertest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_music, date, time', 'required'),
			array('id_user, id_music', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_music, date, time, sex, marker', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'id_user'),
			'test' => array(self::BELONGS_TO, 'MusicTest', 'id_music'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_music' => 'Id Music',
			'date' => 'Date',
			'time' => 'Time',
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
		$criteria->with=array('user','test');
		$criteria->compare('id',$this->id);
		$criteria->compare('t.id_user',$this->id_user);
		$criteria->compare('id_music',$this->id_music);
		$criteria->compare('date',$this->date,true);
		//$criteria->compare('time',$this->time,true);
		$criteria->compare('user.sex',$this->sex);
		$criteria->compare('user.id_education',$this->education);
		$criteria->compare('user.P1',$this->P1);
		//$criteria->compare('user.P2',$this->P2);
		//$criteria->compare('user.region',$this->region);
		$criteria->addBetweenCondition('user.date_birth',$this->after_age(),$this->age_from());
		if($this->time){
			$criteria->addCondition("time>$this->time");
		}
		if($this->region)
			$criteria->addInCondition('user.region',$this->region);
		if(!$this->P2All){
			$criteria->addInCondition('user.P2',$this->P2);
		}
		if($this->marker){
			$criteria->compare('user.marker','+');
		}
		if($this->P1P2){
			$criteria->addColumnCondition(array('P1'=>$this->test->id_radiostation, 'P2'=>$this->test->id_radiostation), 'OR');
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function testuserserch(){
		$criteria=new CDbCriteria;
		$criteria->with=array('user');
		$criteria->compare('id',$this->id);
		$criteria->compare('t.id_user',$this->id_user);
		$criteria->compare('id_music',$this->id_music);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('user.sex',$this->sex);
		$criteria->compare('user.id_education',$this->education);
		$criteria->compare('user.P1',$this->P1);
		$criteria->compare('user.P2',$this->P2);
		$criteria->compare('user.region',$this->region);
		//$criteria->addBetweenCondition('user.date_birth',$this->after_age(),$this->age_from());

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function user()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('user');
		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_music',$this->id_music);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('user.sex',$this->sex);
		$criteria->compare('user.id_education',$this->education);
		$criteria->compare('user.P1',$this->P1);
		$criteria->compare('user.P2',$this->P2);
		$criteria->compare('user.region',$this->region);
		$criteria->addBetweenCondition('user.date_birth',$this->after_age(),$this->age_from());

		return Usertest::model()->findAll($criteria);

	}
	public function age_from(){
		if(!$this->age_from){
			$this->age_from=14;
		}
		$age=$this->age_from*(365*60*60*24);
		$age=abs(time())-$age;

		return date(" Y-m-d",$age);
	}
	public function after_age(){
		if(!$this->after_age){
			$this->after_age=100;
		}
		$age=$this->after_age*(365*60*60*24);
		$age=abs(time())-$age;

		return date(" Y-m-d",$age);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usertest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	protected function afterSave(){
		$cou=count(Usertest::model()->findAll("id_music={$this->id_music}"));

		$max_lisners=MusicTest::model()->findByPk($this->id_music);
		if($max_lisners->getMaxLisners()!='unlim'){
			if($max_lisners->getMaxLisners()<=$cou){
				$max_lisners->id_status=3;
				$max_lisners->save();
			}
		}

	}

}
