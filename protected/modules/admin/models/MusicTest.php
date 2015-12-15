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
	private $licens;
	private $_status;

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
			array('id_status','active'),
			array('date_finished','datefinished'),
		//	array('date_started','datestarted'),
			array('license','license'),

			array('id_test, id_radiostation, id_type,id_status, max_listeners, test_number', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test, id_radiostation, id_type, date_add, date_started,id_status, max_listeners, test_number, date_finished', 'safe', 'on'=>'search'),
		);
	}
	public function license($attribute){
		if($this->radio->status){

			$this->addError($attribute,Yii::t('radio','У вас закончилась лицензия на использование сервиса') );
		}
else{
		if($this->radio->license->test_count<=count($this->radio->MusicTest) and $this->radio->license->test_count){

			$this->addError($attribute,Yii::t('radio','У вас закончилась лицензия на использование сервиса') );
			$this->radio->status=1;

		}

}

	}
	public function active($attribute){
		$criteria=new CDbCriteria();
		$criteria->condition = 'id_radiostation = :id_radiostation AND id_status = :id_status';
		$criteria->params = array(':id_radiostation'=>$this->id_radiostation, ':id_status'=>2);
		$model= self::model()->find($criteria);
		if ($model) {
			if ($this->id_status == 2 and $model->id_test!==$this->id_test )
				$this->addError($attribute,Yii::t('radio','У вас уже есть активный тест закройте его чтобы активировать данный') );
		}
	}
	public function datestarted($attribute){
		$date=date("Y-m-d");
		if($this->date_started)
		if ($this->date_started!=='0000-00-00')
			if(strtotime($this->date_started)< strtotime($date))
				$this->addError($attribute,Yii::t('radio',"Дата старта не может быть прошлая"));
	}
	public function datefinished($attribute){
		if($this->date_finished)
		if ($this->date_finished !=='0000-00-00')
			if(strtotime($this->date_started)> strtotime($this->date_finished))
				$this->addError($attribute,Yii::t('radio',"Дата окончания теста не может быть раньше начала"));
	}



	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'type' => array(self::BELONGS_TO, 'Type', 'id_type'),
			'radio' => array(self::BELONGS_TO, 'Radistations', 'id_radiostation' ),
			'songs'=>array(self::HAS_MANY, 'Songs','id_test'),
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
			'date'=>Yii::t('radio', 'Date'),
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
		$criteria->with=array('type','radio'); // жадная загрузка
		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('t.id_radiostation',$this->id_radiostation);
		$criteria->compare('type.id_type',$this->id_type);
		$criteria->compare('t.date_add',$this->date_add);
		$criteria->compare('date_started',$this->date_started,true);
		$criteria->compare('id_status',$this->id_status);
		$criteria->compare('max_listeners',$this->max_listeners);
		$criteria->compare('test_number',$this->test_number);
		$criteria->compare('date_finished',$this->date_finished,true);
		$criteria->together = true;

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
	protected function afterFind()
	{
		$this->_status=$this->id_status;

	}
	protected function beforeSave()
	{
		if ($this->isNewRecord) {
			$this->id_status = 1;
			$this->date_add = date(" Y-m-d");
		}

		parent::beforeSave();
		return true;

	}

	protected function afterSave(){
		if ($this->isNewRecord){
			$old=Yii::getPathOfAlias('webroot.upload').'/'.Yii::app()->user->id.'/';
			$new=Yii::getPathOfAlias('webroot.musictest').'/'.$this->id_test;
			if(file_exists ($old) ){
				rename($old,$new);
				$files=CFileHelper::findFiles($new, ['fileTypes' => ['mp3',''], 'level' => 1]);
				foreach($files as $file) {
					$songs = new Songs();
					$songs->id_test = $this->id_test;
					//$info = $this->mp3info($file);

						$name=stristr($file,$this->id_test);
						$name=stristr($name,'.mp3',true);
					$name=str_replace($this->id_test."\\","",$name);

					$songs->name = $name;

					$songs->song_file = $file;
					$songs->validate();
					$songs->save();
				}
			}
		}
		if ($this->id_status == 2 and $this->id_type == 1) {
			if ($this->_status!=$this->id_status) {
				$criteria = new CDbCriteria();
				$criteria->condition = 'id_radiostation = :id_radiostation AND id_category=:id_category ';
				$criteria->params = array(':id_radiostation' => $this->id_radiostation, ':id_category' => 3);
				$model = Users::model()->findAll($criteria);

				if ($model) {
					foreach ($model as $user) {
						new UsersInvitation($user,$this->id_test);
					}
				}
			}
		}
		if($this->id_status==3){
			$model=Users::model()->findAll("id_radiostation=".$this->id_radiostation);
			foreach($model as $user){
				$user->link="";
				$user->save();
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


	public function getMaxLisners(){
		$arr=array('unlim',100,120,150,200,250,300,350,400,450,500,600,700,800,900,1000);
		return $arr[$this->max_listeners];
	}
	public function getStatus(){
		$arr= array(1=>Yii::t('radio','Ready'),2=>Yii::t('radio','Started'),3=>Yii::t('radio','Finished'));
		return $arr[$this->id_status];
	}
	protected function afterDelete(){
		Songs::model()->deleteAll("`id_test`={$this->id_test}");
		Usertest::model()->deleteAll("`id_music`={$this->id_test}");
		MusicTestDetail::model()->deleteAll("`id_test`={$this->id_test}");
		parent::afterDelete();
	}
}
