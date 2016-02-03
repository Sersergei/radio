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
	public $active_test;
	public $finished_test;
	public $date;
	public $test_count;
	public $login;
	public $password;
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
			array('all_tests, status, id_languege', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
			array('location', 'length', 'max'=>255),
			array('date_add, date, test_count,login, password', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_radiostation, name, location, all_tests, date_add, status, id_languege', 'safe', 'on'=>'search'),
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
			'radiostationSettings' => array(self::HAS_ONE, 'RadiostationSettings', 'id_radiostation'),
			'settings' => array(self::HAS_ONE, 'TestSettingsMult', 'id_radiostations'),
			'testsettings' => array(self::HAS_ONE, 'TestSettings', 'id_radiostation'),
			'users' => array(self::HAS_MANY, 'Users', 'id_radiostation'),
			'users1' => array(self::BELONGS_TO, 'Users', 'P1'),
			'lang' => array(self::BELONGS_TO, 'Lang', 'id_languege'),
			'MusicTest' => array(self::HAS_MANY, 'MusicTest', 'id_radiostation'),
			'license'=>array(self::HAS_ONE,'License','id_radiostation'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_radiostation' => 'Id Radiostation',
			'name' => Yii::t('radio','Name'),
			'location' => Yii::t('radio','Location'),
			'all_tests' => Yii::t('radio','All Tests'),
			'date_add' => Yii::t('radio','Date Add'),
			'status' => Yii::t('radio','Status'),
			'id_languege'=>Yii::t('radio','Lang'),
			'date'=>Yii::t('radio','license date'),
			'test_count'=>Yii::t('radio','test_count'),
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
		//$criteria->with=array('radiostationSettings','settings','MusicTest','testsettings'); // ������ ��������
		$criteria->compare('id_radiostation',$this->id_radiostation);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('all_tests',$this->all_tests);
		$criteria->compare('date_add',$this->date_add,true);
		$criteria->compare('status',$this->status);
		//$criteria->compare('songs',$this->songs);
		$criteria->compare('Lang',$this->id_languege);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pagesize' => 50,
			),
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
	public static function all(){
		$models=self::model()->findAll();
		$array=array();
		foreach($models as $radio){
			$array[$radio->id_radiostation] = $radio->name;
		}
		return $array;
	}
	public  function finduser(){

		$criteria=new CDbCriteria;
		$criteria->condition = 'id_radiostation = :id_radiostation AND id_category =:id_category';
		$criteria->params = array(':id_radiostation'=>$this->id_radiostation, ':id_category'=>2);
		$user=Users::model()->find($criteria);

		return $user;
	}
	protected function beforeSave(){

		if(strtotime($this->date)>strtotime(date("Y-m-d")) or $this->test_count>count($this->MusicTest)){

			$this->status=0;
		}
		else{
			$this->status=1;
		}
		parent::beforeSave();
		return true;
	}
	protected function afterSave(){
		if ($this->isNewRecord){
			$license=new License();
			$license->id_radiostation=$this->id_radiostation;
			$license->save();
		}
		else{

			License::model()->updateall(array('date'=>$this->date,
												'test_count'=>$this->test_count),
										'id_radiostation=:id_radiostation',
										array('id_radiostation'=>$this->id_radiostation));
			Users::model()->updateall(array('login'=>$this->login,
											'password'=>$this->password),
											'id_radiostation=:id_radiostation and id_category=:id_category',
											array('id_radiostation'=>$this->id_radiostation,'id_category'=>2));
		}

	}
	protected function afterDelete()
	{
		Users::model()->deleteAll("`id_radiostation`={$this->id_radiostation}");
		RadiostationSettings::model()->deleteAll("`id_radiostation`={$this->id_radiostation}");
		TestSettings::model()->deleteAll("`id_radiostation`={$this->id_radiostation}");
		TestSettingsMult::model()->deleteAll("`id_radiostations`={$this->id_radiostation}");
		MusicTest::model()->deleteAll("`id_radiostation`={$this->id_radiostation}");
		License::model()->deleteAll("`id_radiostation`={$this->id_radiostation}");

		parent::afterDelete();
	}
	protected function afterFind()
	{
		parent::afterFind();
		$license=License::model()->find('id_radiostation=:id_radiostation',
			array('id_radiostation'=>$this->id_radiostation));
		$this->date=$license->date;
		$this->test_count=$license->test_count;
		$user=Users::model()->find('id_radiostation=:id_radiostation and id_category=:id_category',
			array('id_radiostation'=>$this->id_radiostation,'id_category'=>2));
		$this->login=$user->login;
		$this->password=$user->password;
	}
}
