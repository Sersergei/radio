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
			array('id_type','required'),
			array('id_test, id_radiostation, id_type,id_status, max_listeners, test_number', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test, id_radiostation, id_type, date_add, date_started,id_status, max_listeners, test_number, date_finished', 'safe', 'on'=>'search'),
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
			'type_id' => array(self::BELONGS_TO, 'Type', 'id_type'),
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_test' => Yii::t('radio', 'Id Test'),
			'id_radiostation' =>Yii::t('radio', 'Id Radiostation'),
			'id_type' =>Yii::t('radio', 'Id Type'),
			'date_add' =>Yii::t('radio', 'Date Add'),
			'date_started' =>Yii::t('radio', 'Date Started'),
			'id_status' =>Yii::t('radio', 'Id Status'),
			'max_listeners' =>Yii::t('radio', 'Max Listeners'),
			'test_number' =>Yii::t('radio', 'Test Number'),
			'date_finished' =>Yii::t('radio', 'Date Finished'),
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
		//$criteria->with=array('type_id'); // Р¶Р°РґРЅР°СЏ Р·Р°РіСЂСѓР·РєР°
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('id_radiostation',$this->id_radiostation);
		$criteria->compare('type.id_type',$this->id_type);
		$criteria->compare('date_add',$this->date_add,true);
		$criteria->compare('date_started',$this->date_started,true);
		$criteria->compare('id_status',$this->id_status);
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
	protected function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
			$this->id_radiostation=$user->id_radiostation;
			$this->id_status=1;
			$this->date_add= date(" Y-m-d");
			}
		parent::beforeSave();
		return true;
	}
	protected function afterSave(){
		if ($this->isNewRecord){
			$old='./upload/'.Yii::app()->user->id.'/';
			$new='./musictest/'.$this->id_test.'/';
			rename($old,$new);
			$files=CFileHelper::findFiles($new, ['fileTypes' => ['mp3',''], 'level' => 1]);
			foreach($files as $file){
				$songs=new Songs();
				$songs->id_test=$this->id_test;
				$info=$this->mp3info($file);
				$songs->name=$info['NAME'];
				$songs->singer=$info['ARTISTS'];
				$songs->song_file=$file;
				$songs->save();
			}
		}
	}
	protected function mp3info($file){
		$f = fopen($file, 'rb');
		rewind($f);
		fseek($f, -128, SEEK_END);
		$tmp = fread($f,128);
		if ($tmp[125] == Chr(0) and $tmp[126] != Chr(0)) {
			// ID3 v1.1
			$format = 'a3TAG/a30NAME/a30ARTISTS/a30ALBUM/a4YEAR/a28COMMENT/x1/C1TRACK/C1GENRENO';
		} else {
			// ID3 v1
			$format = 'a3TAG/a30NAME/a30ARTISTS/a30ALBUM/a4YEAR/a30COMMENT/C1GENRENO';
		}

		return $id3tag = unpack($format, $tmp);
	}
}
