<?php

/**
 * This is the model class for table "music_test_detail".
 *
 * The followings are the available columns in table 'music_test_detail':
 * @property integer $id_test_det
 * @property integer $id_test
 * @property integer $id_user
 * @property string $date_last
 * @property integer $finaly
 * @property integer $id_song
 * @property integer $id_like
 *
 * The followings are the available model relations:
 * @property MusicTest $idTest
 * @property Users $idUser
 * @property Songs $idSong
 * @property SongLikesMult $idLike
 */
class MusicTestDetail extends CActiveRecord
{
	public $like;
	public $normal;
	public $tired;
	public $dislike;
	public $favorite;
	public $never;
	public $favorite_P1;
	public $like_P1;
	public $normal_P1;
	public $tired_P1;
	public $dislike_P1;
	public $never_P1;
	public $favorite_P2;
	public $like_P2;
	public $normal_P2;
	public $tired_P2;
	public $dislike_P2;
	public $never_P2;
	public $song_name;
	public $positive;
	public $negative;
	public $positive_P1;
	public $negative_P1;
	public $positive_P2;
	public $negative_P2;
	public $sex;
	public $age_from;
	public $after_age;
	public $id_education;
	public $P1;
	public $P2;
	public $Coun;
	public $Coun1;
	public $Coun2;
	public $Coun3;
	public $Coun4;
	public $Coun5;
	public $CounP1;
	public $CounP11;
	public $CounP12;
	public $CounP13;
	public $CounP14;
	public $CounP15;
	public $CounP2;
	public $CounP21;
	public $CounP22;
	public $CounP23;
	public $CounP24;
	public $CounP25;
	public $neverP1;
	public $neverP2;
	public $region;
	public $P2All;
	public $marker;
	public $P1P2;
	public $time;
	public $ip;



	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'music_test_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_last, id_song', 'required'),
			array('id_test, id_user, id_song, id_like, never,ip', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test_det, id_test, id_user, date_last, finaly, id_song, id_like, sex, age_from, after_age,
					id_education,P1,P2,P2All,marker,P1P2,time,ip, region', 'safe', 'on'=>'search'),
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
			'idTest' => array(self::BELONGS_TO, 'MusicTest', 'id_test'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
			'idSong' => array(self::BELONGS_TO, 'Songs', 'id_song'),
			'idLike' => array(self::BELONGS_TO, 'SongLikesMult', 'id_like'),
			'usertest'=>array(self::BELONGS_TO,'Usertest',array('id_user'=>'id_user','id_test'=>'id_music')),
			//'usertest'=>array(self::BELONGS_TO,'Usertest','id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_test_det' => 'Id Test Det',
			'id_test' => 'Id Test',
			'id_user' => 'Id User',
			'date_last' => 'Date Last',
			'finaly' => 'Finaly',
			'id_song' => 'Id Song',
			'id_like' => 'Id Like',
			'age_from'=>'Age',
			'P2All'=>'All',
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
		$criteria->with=array('idUser','idTest','usertest');
		$criteria->compare('id_test_det',$this->id_test_det);
		$criteria->compare('idTest.id_test',$this->id_test);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('date_last',$this->date_last,true);
		$criteria->compare('finaly',$this->finaly);
		$criteria->compare('id_song',$this->id_song);
		$criteria->compare('id_like',$this->id_like);
		$criteria->addInCondition('idUser.P1',$this->P1);
		if($this->P1P2){
			$criteria->addColumnCondition(array('P1'=>$this->idTest->id_radiostation, 'P2'=>$this->idTest->id_radiostation), 'OR');
		}
		if($this->time){
			//$criteria->addBetweenCondition('usertest.date',time(),time($this->time));
			//$criteria->addCondition(" 'usertest.date'= '2016-02-08'" );
			$criteria->addCondition("usertest.time>$this->time");

			//$criteria->condition="usertest.id=243";
		}

		$criteria->addInCondition('idUser.sex',$this->sex);
		$criteria->addInCondition('idUser.region',$this->region);
		if(!$this->P2All){
			$criteria->addInCondition('idUser.P2',$this->P2);
		}
		if($this->marker){
			$criteria->compare('idUser.marker','+');
		}
		//$criteria->addCondition(new CDbExpression(" usertest.ip=INET_ATON('82.131.100.233')"));

		if($this->ip){
			$criteria->addCondition(new CDbExpression("usertest.ip Between INET_ATON('5.101.112.0') AND INET_ATON('5.101.127.255 ')
														OR usertest.ip Between INET_ATON('5.101.176.0') AND INET_ATON('5.101.191.255')
														OR usertest.ip Between INET_ATON('5.157.0.0') AND INET_ATON('5.157.63.255')
														OR usertest.ip Between INET_ATON('37.157.64.0') AND INET_ATON('37.157.127.255')
														OR usertest.ip Between INET_ATON('46.22.208.0') AND INET_ATON('46.22.223.255')
														OR usertest.ip Between INET_ATON('46.39.128.0') AND INET_ATON('46.39.159.255')
														OR usertest.ip Between INET_ATON('46.131.0.0') AND INET_ATON('46.131.255.255')
														OR usertest.ip Between INET_ATON('62.65.32.0') AND INET_ATON('62.65.63.255')
														OR usertest.ip Between INET_ATON('62.65.192.0') AND INET_ATON('62.65.255.255')
														OR usertest.ip Between INET_ATON('77.233.64.0') AND INET_ATON('77.233.95.255')
														OR usertest.ip Between INET_ATON('77.240.240.0') AND INET_ATON('77.240.255.255')
														OR usertest.ip Between INET_ATON('78.28.64.0') AND INET_ATON('78.28.127.255')
														OR usertest.ip Between INET_ATON('78.110.32.0') AND INET_ATON('78.110.47.255')
														OR usertest.ip Between INET_ATON('79.134.192.0') AND INET_ATON('79.134.223.255')
														OR usertest.ip Between INET_ATON('80.66.240.0') AND INET_ATON('80.66.255.255')
														OR usertest.ip Between INET_ATON('80.79.112.0') AND INET_ATON('80.79.127.255')
														OR usertest.ip Between INET_ATON('80.235.0.0') AND INET_ATON('80.235.127.255')
														OR usertest.ip Between INET_ATON('80.250.112.0') AND INET_ATON('80.250.127.255')
														OR usertest.ip Between INET_ATON('81.20.144.0') AND INET_ATON('81.20.159.255')
														OR usertest.ip Between INET_ATON('81.21.240.0') AND INET_ATON('81.21.255.255')
														OR usertest.ip Between INET_ATON('81.25.240.0') AND INET_ATON('81.25.255.255')
														OR usertest.ip Between INET_ATON('81.90.112.0') AND INET_ATON('81.90.127.255')
														OR usertest.ip Between INET_ATON('82.131.0.0') AND INET_ATON('82.131.127.255')
														OR usertest.ip Between INET_ATON('82.147.160.0') AND INET_ATON('82.147.191.255')
														OR usertest.ip Between INET_ATON('83.166.32.0') AND INET_ATON('83.166.63.255')
														OR usertest.ip Between INET_ATON('84.50.0.0') AND INET_ATON('84.50.255.255')
														OR usertest.ip Between INET_ATON('84.52.0.0') AND INET_ATON('84.52.63.255')
														OR usertest.ip Between INET_ATON('85.29.192.0') AND INET_ATON('85.29.255.255')
														OR usertest.ip Between INET_ATON('85.89.32.0') AND INET_ATON('85.89.63.255')
														OR usertest.ip Between INET_ATON('85.117.96.0') AND INET_ATON('85.117.127.255')
														OR usertest.ip Between INET_ATON('85.196.192.0') AND INET_ATON('85.196.255.255')
														OR usertest.ip Between INET_ATON('85.253.0.0') AND INET_ATON('85.253.255.255')
														OR usertest.ip Between INET_ATON('86.110.32.0') AND INET_ATON('86.110.63.255')
														OR usertest.ip Between INET_ATON('87.98.0.0') AND INET_ATON('87.98.127.255')
														OR usertest.ip Between INET_ATON('87.119.160.0') AND INET_ATON('87.119.191.255')
														OR usertest.ip Between INET_ATON('88.196.0.0') AND INET_ATON('88.196.255.255')
														OR usertest.ip Between INET_ATON('89.221.64.0') AND INET_ATON('89.221.79.255')
														OR usertest.ip Between INET_ATON('89.235.192.0') AND INET_ATON('89.235.255.255')
														OR usertest.ip Between INET_ATON('90.190.0.0') AND INET_ATON('90.191.255.255')
														OR usertest.ip Between INET_ATON('91.146.64.0') AND INET_ATON('91.146.95.255')
														OR usertest.ip Between INET_ATON('92.62.96.0') AND INET_ATON('92.62.111.255')
														OR usertest.ip Between INET_ATON('93.185.240.0') AND INET_ATON('93.185.255.255')
														OR usertest.ip Between INET_ATON('94.246.192.0') AND INET_ATON('94.246.255.255')
														OR usertest.ip Between INET_ATON('95.153.0.0') AND INET_ATON('95.153.63.255')
														OR usertest.ip Between INET_ATON('176.46.0.0') AND INET_ATON('176.46.127.255')
														OR usertest.ip Between INET_ATON('178.236.192.0') AND INET_ATON('178.236.207.255')
														OR usertest.ip Between INET_ATON('188.0.48.0') AND INET_ATON('188.0.63.255')
														OR usertest.ip Between INET_ATON('193.40.0.0') AND INET_ATON('193.40.255.255')
														OR usertest.ip Between INET_ATON('194.106.96.0') AND INET_ATON('194.106.127.255')
														OR usertest.ip Between INET_ATON('194.126.96.0') AND INET_ATON('194.126.127.255')
														OR usertest.ip Between INET_ATON('194.204.0.0') AND INET_ATON('194.204.31.255')
														OR usertest.ip Between INET_ATON('195.50.192.0') AND INET_ATON('195.50.223.255')
														OR usertest.ip Between INET_ATON('195.50.224.0') AND INET_ATON('195.50.255.255')
														OR usertest.ip Between INET_ATON('195.80.96.0') AND INET_ATON('195.80.127.255')
														OR usertest.ip Between INET_ATON('195.222.0.0') AND INET_ATON('195.222.31.255')
														OR usertest.ip Between INET_ATON('195.250.160.0') AND INET_ATON('195.250.191.255')
														OR usertest.ip Between INET_ATON('212.7.0.0') AND INET_ATON('212.7.31.255')
														OR usertest.ip Between INET_ATON('212.27.224.0') AND INET_ATON('212.27.255.255')
														OR usertest.ip Between INET_ATON('212.49.0.0') AND INET_ATON('212.49.31.255')
														OR usertest.ip Between INET_ATON('212.107.32.0') AND INET_ATON('212.107.63.255')
														OR usertest.ip Between INET_ATON('213.35.128.0') AND INET_ATON('213.35.255.255')
														OR usertest.ip Between INET_ATON('213.168.0.0') AND INET_ATON('213.168.31.255')
														OR usertest.ip Between INET_ATON('213.180.0.0') AND INET_ATON('213.180.31.255')
														OR usertest.ip Between INET_ATON('213.184.32.0') AND INET_ATON('213.184.63.255')
														OR usertest.ip Between INET_ATON('213.187.224.0') AND INET_ATON('213.187.239.255')
														OR usertest.ip Between INET_ATON('213.219.64.0') AND INET_ATON('213.219.127.255')
														OR usertest.ip Between INET_ATON('217.71.32.0') AND INET_ATON('217.71.47.255')
														OR usertest.ip Between INET_ATON('217.146.64.0') AND INET_ATON('217.146.79.255')
														OR usertest.ip Between INET_ATON('217.159.128.0') AND INET_ATON('217.159.255.255')
														"));
		}

$criteria->select = "`t`.*, COUNT(*) as Coun,
		COUNT(CASE WHEN never=5 THEN 1 ELSE NULL END) as never,
		COUNT(CASE WHEN id_like=5 THEN 1 ELSE NULL END) as Coun5,
		COUNT(CASE WHEN id_like=4 THEN 1 ELSE NULL END) as Coun4,
		COUNT(CASE WHEN id_like=3 THEN 1 ELSE NULL END) as Coun3,
		COUNT(CASE WHEN id_like=2 THEN 1 ELSE NULL END) as Coun2,
		COUNT(CASE WHEN id_like=1 THEN 1 ELSE NULL END) as Coun1,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} THEN 1 ELSE NULL END) as CounP1,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND never=5 THEN 1 ELSE NULL END) as neverP1,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=5 THEN 1 ELSE NULL END) as CounP15,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=4 THEN 1 ELSE NULL END) as CounP14,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=3 THEN 1 ELSE NULL END) as CounP13,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=2 THEN 1 ELSE NULL END) as CounP12,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=1 THEN 1 ELSE NULL END) as CounP11,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} THEN 1 ELSE NULL END) as CounP2,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} AND never=5 THEN 1 ELSE NULL END) as neverP2,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} AND id_like=5 THEN 1 ELSE NULL END) as CounP25,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} AND id_like=4 THEN 1 ELSE NULL END) as CounP24,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} AND id_like=3 THEN 1 ELSE NULL END) as CounP23,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} AND id_like=2 THEN 1 ELSE NULL END) as CounP22,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} AND id_like=1 THEN 1 ELSE NULL END) as CounP21

                                                  ";
		//$criteria->select = '`t`.*, COUNT(`t`.`id_like`) as Coun1';
		$criteria->addInCondition('idUser.id_education',$this->id_education);
		$criteria->addBetweenCondition('idUser.date_birth',$this->after_age(),$this->age_from());
		$criteria->group='id_song';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pagesize' => 50,
			),
		));
	}
	public function users(){
		$criteria=new CDbCriteria;
		$criteria->compare('id_test_det',$this->id_test_det);
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('date_last',$this->date_last,true);
		$criteria->compare('finaly',$this->finaly);
		$criteria->compare('id_song',$this->id_song);
		$criteria->compare('id_like',$this->id_like);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pagesize' => 50,
			),
		));
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
	public function getfavorite($like,$p=Null){
		$criteria=new CDbCriteria;
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('id_song',$this->id_song);
		$criteria->compare('id_like',$like);
		if($p==1){
			$criteria->with="idUser";
			$criteria->compare('idUser.P1',$this->idUser->id_radiostation);
		}
		if($p==2){
			$criteria->with="idUser";
			$criteria->compare('idUser.P2',$this->idUser->id_radiostation);
		}
		$model=MusicTestDetail::model()->findall($criteria);
		return count($model);
	}
	public function getnever($p=Null){
		$criteria=new CDbCriteria;
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('id_song',$this->id_song);
		$criteria->compare('never',1);
		if($p==1){
			$criteria->with="idUser";
			$criteria->compare('idUser.P1',$this->idUser->id_radiostation);
		}
		if($p==2){
			$criteria->with="idUser";
			$criteria->compare('idUser.P2',$this->idUser->id_radiostation);
		}
		$model=MusicTestDetail::model()->findall($criteria);
		return count($model);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MusicTestDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getCounP2(){
		if($this->CounP2){
			return $this->CounP2;
		}
		else{
			return 1;
		}
	}
	public function getCounP1(){
		if($this->CounP1){
			return $this->CounP1;
		}
		else{
			return 1;
		}
	}
	public function getCoun(){
		if($this->Coun){
			return $this->Coun;
		}
		else{
			return 1;
		}
	}
	public function gettime(){
		return time($this->time);
	}
	public function getnevers(){
		if ($this->never)
			return "Yes";
		else
			return "No";
	}
}
