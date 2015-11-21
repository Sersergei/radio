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
	public $never;
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
			array('id_test, id_user, id_song, id_like', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test_det, id_test, id_user, date_last, finaly, id_song, id_like', 'safe', 'on'=>'search'),
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

		$criteria->compare('id_test_det',$this->id_test_det);
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('date_last',$this->date_last,true);
		$criteria->compare('finaly',$this->finaly);
		$criteria->compare('id_song',$this->id_song);
		$criteria->compare('id_like',$this->id_like);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
}
