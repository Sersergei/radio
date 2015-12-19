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
			array('id_user, date_last, id_song, id_like', 'required'),
			array('id_test, id_user, id_song, id_like, never', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test_det, id_test, id_user, date_last, finaly, id_song, id_like, sex, age_from, after_age, id_education,P1,P2', 'safe', 'on'=>'search'),
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
		$criteria->with=array('idUser','idTest');
		$criteria->compare('id_test_det',$this->id_test_det);
		$criteria->compare('idTest.id_test',$this->id_test);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('date_last',$this->date_last,true);
		$criteria->compare('finaly',$this->finaly);
		$criteria->compare('id_song',$this->id_song);
		$criteria->compare('id_like',$this->id_like);
		$criteria->addInCondition('idUser.P1',$this->P1);
		$criteria->addInCondition('idUser.P2',$this->P2);
		$criteria->addInCondition('idUser.sex',$this->sex);
		$criteria->select = "`t`.*, COUNT(*) as Coun,
		COUNT(CASE WHEN never=1 THEN 1 ELSE NULL END) as never,
		COUNT(CASE WHEN id_like=5 THEN 1 ELSE NULL END) as Coun5,
		COUNT(CASE WHEN id_like=4 THEN 1 ELSE NULL END) as Coun4,
		COUNT(CASE WHEN id_like=3 THEN 1 ELSE NULL END) as Coun3,
		COUNT(CASE WHEN id_like=2 THEN 1 ELSE NULL END) as Coun2,
		COUNT(CASE WHEN id_like=1 THEN 1 ELSE NULL END) as Coun1,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} THEN 1 ELSE NULL END) as CounP1,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND never=1 THEN 1 ELSE NULL END) as neverP1,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=5 THEN 1 ELSE NULL END) as CounP15,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=4 THEN 1 ELSE NULL END) as CounP14,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=3 THEN 1 ELSE NULL END) as CounP13,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=2 THEN 1 ELSE NULL END) as CounP12,
		COUNT(CASE WHEN idUser.P1= {$this->idTest->id_radiostation} AND id_like=1 THEN 1 ELSE NULL END) as CounP11,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} THEN 1 ELSE NULL END) as CounP2,
		COUNT(CASE WHEN idUser.P2= {$this->idTest->id_radiostation} AND never=1 THEN 1 ELSE NULL END) as neverP2,
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
}
