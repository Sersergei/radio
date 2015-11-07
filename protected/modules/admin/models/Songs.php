<?php

/**
 * This is the model class for table "songs".
 *
 * The followings are the available columns in table 'songs':
 * @property integer $id_song
 * @property string $singer
 * @property string $name
 * @property string $song_file
 * @property integer $id_test
 *
 * The followings are the available model relations:
 * @property MusicTestDetail[] $musicTestDetails
 */
class Songs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'songs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('singer, name, song_file, id_test', 'required'),
			array('id_test', 'numerical', 'integerOnly'=>true),
			array('singer, name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_song, singer, name, song_file, id_test', 'safe', 'on'=>'search'),
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
			'musicTestDetails' => array(self::HAS_MANY, 'MusicTestDetail', 'id_song'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_song' => 'Id Song',
			'singer' => 'Singer',
			'name' => 'Name',
			'song_file' => 'Song File',
			'id_test' => 'Id Test',
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

		$criteria->compare('id_song',$this->id_song);
		$criteria->compare('singer',$this->singer,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('song_file',$this->song_file,true);
		$criteria->compare('id_test',$this->id_test);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Songs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
