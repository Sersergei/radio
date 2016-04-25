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
			array('id_user, id_music, date, time, ip', 'required'),
			array('id_user, id_music', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_music, date, time, sex, marker, ip', 'safe', 'on'=>'search'),
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
			'ip'=>'IP',
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
		if($this->ip){

			$criteria->addCondition(new CDbExpression("t.ip Between INET_ATON('5.101.112.0') AND INET_ATON('5.101.127.255 ')
														OR t.ip Between INET_ATON('5.101.176.0') AND INET_ATON('5.101.191.255')
														OR t.ip Between INET_ATON('5.157.0.0') AND INET_ATON('5.157.63.255')
														OR t.ip Between INET_ATON('37.157.64.0') AND INET_ATON('37.157.127.255')
														OR t.ip Between INET_ATON('46.22.208.0') AND INET_ATON('46.22.223.255')
														OR t.ip Between INET_ATON('46.39.128.0') AND INET_ATON('46.39.159.255')
														OR t.ip Between INET_ATON('46.131.0.0') AND INET_ATON('46.131.255.255')
														OR t.ip Between INET_ATON('62.65.32.0') AND INET_ATON('62.65.63.255')
														OR t.ip Between INET_ATON('62.65.192.0') AND INET_ATON('62.65.255.255')
														OR t.ip Between INET_ATON('77.233.64.0') AND INET_ATON('77.233.95.255')
														OR t.ip Between INET_ATON('77.240.240.0') AND INET_ATON('77.240.255.255')
														OR t.ip Between INET_ATON('78.28.64.0') AND INET_ATON('78.28.127.255')
														OR t.ip Between INET_ATON('78.110.32.0') AND INET_ATON('78.110.47.255')
														OR t.ip Between INET_ATON('79.134.192.0') AND INET_ATON('79.134.223.255')
														OR t.ip Between INET_ATON('80.66.240.0') AND INET_ATON('80.66.255.255')
														OR t.ip Between INET_ATON('80.79.112.0') AND INET_ATON('80.79.127.255')
														OR t.ip Between INET_ATON('80.235.0.0') AND INET_ATON('80.235.127.255')
														OR t.ip Between INET_ATON('80.250.112.0') AND INET_ATON('80.250.127.255')
														OR t.ip Between INET_ATON('81.20.144.0') AND INET_ATON('81.20.159.255')
														OR t.ip Between INET_ATON('81.21.240.0') AND INET_ATON('81.21.255.255')
														OR t.ip Between INET_ATON('81.25.240.0') AND INET_ATON('81.25.255.255')
														OR t.ip Between INET_ATON('81.90.112.0') AND INET_ATON('81.90.127.255')
														OR t.ip Between INET_ATON('82.131.0.0') AND INET_ATON('82.131.127.255')
														OR t.ip Between INET_ATON('82.147.160.0') AND INET_ATON('82.147.191.255')
														OR t.ip Between INET_ATON('83.166.32.0') AND INET_ATON('83.166.63.255')
														OR t.ip Between INET_ATON('84.50.0.0') AND INET_ATON('84.50.255.255')
														OR t.ip Between INET_ATON('84.52.0.0') AND INET_ATON('84.52.63.255')
														OR t.ip Between INET_ATON('85.29.192.0') AND INET_ATON('85.29.255.255')
														OR t.ip Between INET_ATON('85.89.32.0') AND INET_ATON('85.89.63.255')
														OR t.ip Between INET_ATON('85.117.96.0') AND INET_ATON('85.117.127.255')
														OR t.ip Between INET_ATON('85.196.192.0') AND INET_ATON('85.196.255.255')
														OR t.ip Between INET_ATON('85.253.0.0') AND INET_ATON('85.253.255.255')
														OR t.ip Between INET_ATON('86.110.32.0') AND INET_ATON('86.110.63.255')
														OR t.ip Between INET_ATON('87.98.0.0') AND INET_ATON('87.98.127.255')
														OR t.ip Between INET_ATON('87.119.160.0') AND INET_ATON('87.119.191.255')
														OR t.ip Between INET_ATON('88.196.0.0') AND INET_ATON('88.196.255.255')
														OR t.ip Between INET_ATON('89.221.64.0') AND INET_ATON('89.221.79.255')
														OR t.ip Between INET_ATON('89.235.192.0') AND INET_ATON('89.235.255.255')
														OR t.ip Between INET_ATON('90.190.0.0') AND INET_ATON('90.191.255.255')
														OR t.ip Between INET_ATON('91.146.64.0') AND INET_ATON('91.146.95.255')
														OR t.ip Between INET_ATON('92.62.96.0') AND INET_ATON('92.62.111.255')
														OR t.ip Between INET_ATON('93.185.240.0') AND INET_ATON('93.185.255.255')
														OR t.ip Between INET_ATON('94.246.192.0') AND INET_ATON('94.246.255.255')
														OR t.ip Between INET_ATON('95.153.0.0') AND INET_ATON('95.153.63.255')
														OR t.ip Between INET_ATON('176.46.0.0') AND INET_ATON('176.46.127.255')
														OR t.ip Between INET_ATON('178.236.192.0') AND INET_ATON('178.236.207.255')
														OR t.ip Between INET_ATON('188.0.48.0') AND INET_ATON('188.0.63.255')
														OR t.ip Between INET_ATON('193.40.0.0') AND INET_ATON('193.40.255.255')
														OR t.ip Between INET_ATON('194.106.96.0') AND INET_ATON('194.106.127.255')
														OR t.ip Between INET_ATON('194.126.96.0') AND INET_ATON('194.126.127.255')
														OR t.ip Between INET_ATON('194.204.0.0') AND INET_ATON('194.204.31.255')
														OR t.ip Between INET_ATON('195.50.192.0') AND INET_ATON('195.50.223.255')
														OR t.ip Between INET_ATON('195.50.224.0') AND INET_ATON('195.50.255.255')
														OR t.ip Between INET_ATON('195.80.96.0') AND INET_ATON('195.80.127.255')
														OR t.ip Between INET_ATON('195.222.0.0') AND INET_ATON('195.222.31.255')
														OR t.ip Between INET_ATON('195.250.160.0') AND INET_ATON('195.250.191.255')
														OR t.ip Between INET_ATON('212.7.0.0') AND INET_ATON('212.7.31.255')
														OR t.ip Between INET_ATON('212.27.224.0') AND INET_ATON('212.27.255.255')
														OR t.ip Between INET_ATON('212.49.0.0') AND INET_ATON('212.49.31.255')
														OR t.ip Between INET_ATON('212.107.32.0') AND INET_ATON('212.107.63.255')
														OR t.ip Between INET_ATON('213.35.128.0') AND INET_ATON('213.35.255.255')
														OR t.ip Between INET_ATON('213.168.0.0') AND INET_ATON('213.168.31.255')
														OR t.ip Between INET_ATON('213.180.0.0') AND INET_ATON('213.180.31.255')
														OR t.ip Between INET_ATON('213.184.32.0') AND INET_ATON('213.184.63.255')
														OR t.ip Between INET_ATON('213.187.224.0') AND INET_ATON('213.187.239.255')
														OR t.ip Between INET_ATON('213.219.64.0') AND INET_ATON('213.219.127.255')
														OR t.ip Between INET_ATON('217.71.32.0') AND INET_ATON('217.71.47.255')
														OR t.ip Between INET_ATON('217.146.64.0') AND INET_ATON('217.146.79.255')
														OR t.ip Between INET_ATON('217.159.128.0') AND INET_ATON('217.159.255.255')
														"));
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
		if($this->marker){
			$criteria->compare('user.marker','+');
		}
		if($this->P1P2){
			$criteria->addColumnCondition(array('P1'=>$this->test->id_radiostation, 'P2'=>$this->test->id_radiostation), 'OR');
		}

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
	protected function afterFind()
	{
		parent::afterFind();
		$this->ip=long2ip($this->ip);
	}

}
