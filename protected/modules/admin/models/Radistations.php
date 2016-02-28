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
	public $license_date;
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
			array('image', 'file', 'types'=>'jpg, gif, png'),
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
			'finished_test'=>'Finished',
			'active_test'=>'Active',
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
	public function getstatus(){
		if($this->status)
			return 'ban';
		else
			return 'act';
	}
	public function getLicenseCount(){
		if($this->license->test_count)
		return $this->license->test_count-count($this->MusicTest);
		else
			return Null;
	}
	public function getLicenseDate(){
		if($this->license->date and $this->license->date!=='0000-00-00')
		return $this->license->date;
		else
			return Null;
	}
	static function statistic($id){


		$model = new Users('search');
		$model->id_education=Null;

		$model->id_radiostation =$id;


		$model->id_category=3;
		$model->status_statistic=1;
		//пїЅпїЅпїЅпїЅпїЅ
		$statistic['all']=count($model->sereachuser());

		$model->status = 1;
		$statistic['ban'] = count($model->sereachuser());

//пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅ

		$model->status = Null;

		$model->create = date(" Y-m-d", strtotime("-1 week"));
		$statistic['all_week'] = count($model->sereachuser());
		if (!$statistic['all_week'])

			$model->status = 1;
		$statistic['ban_week'] = count($model->sereachuser());


//пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅ

		$model->status = Null;

		$model->create = date(" Y-m-d", strtotime("-1 month"));
		$statistic['all_month'] = count($model->sereachuser());
		$model->status = 1;
		$statistic['ban_month'] = count($model->sereachuser());

//пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅ
		$model->status = Null;
		$model->status_statistic = 1;
		$model->create = date(" Y-m-d", strtotime("-1 year"));
		$statistic['all_year'] = count($model->sereachuser());
		$model->status = 1;
		$statistic['ban_year'] = count($model->sereachuser());


		$model->status = Null;
		$model->create = Null;
		$model->active = 1;

		$statistic['count_all'] = count($model->sereachuser());
		if($statistic['count_all']) {
			$model->sex = 1;
			$statistic['count_all_man'] = count($model->sereachuser());
			$model->sex = 2;
			$statistic['count_all_woman'] = count($model->sereachuser());
			unset($model->sex);
			//$model->sex = Null;

			$model->after_age = 14;
			$model->age_from = 1;
			$statistic['count_0_14'] = count($model->sereachuser());


			$model->after_age = 19;
			$model->age_from = 15;
			$statistic['count_15_19'] = count($model->sereachuser());


			$model->after_age = 24;
			$model->age_from = 20;
			$statistic['count_20_24'] = count($model->sereachuser());


			$model->after_age = 29;
			$model->age_from = 25;
			$statistic['count_25_29'] = count($model->sereachuser());

			$model->sex = Null;

			$model->after_age = 34;
			$model->age_from = 30;
			$statistic['count_30_34'] = count($model->sereachuser());


			$model->after_age = 39;
			$model->age_from = 35;
			$statistic['count_35_39'] = count($model->sereachuser());


			$model->after_age = 44;
			$model->age_from = 40;
			$statistic['count_40_44'] = count($model->sereachuser());


			$model->after_age = 49;
			$model->age_from = 45;
			$statistic['count_45_49'] = count($model->sereachuser());


			$model->after_age = 100;
			$model->age_from = 50;
			$statistic['count_50'] = count($model->sereachuser());
			$model->after_age = Null;
			$model->age_from = Null;
			$statistic['educations'] = EducationMult::all();

			$educations = array_keys($statistic['educations']);

			foreach ($educations as $education) {
				$model->id_education = $education;
				$statistic['education'][$education] = count($model->sereachuser());
			}


			$model->education = Null;
			$statistic['radiostations'] = RadiostationSettings::getradiostation($id);

			$radiostations = array_keys($statistic['radiostations']);

			foreach ($radiostations as $radiostation) {
				$model->P1 = $radiostation;
				$statistic['P1'][$radiostation] = count($model->sereachuser());
			}

			$model->P1 = Null;
			foreach ($radiostations as $radiostation) {
				$model->P2 = $radiostation;
				$statistic['P2'][$radiostation] = count($model->sereachuser());
			}

			$model->P2 = Null;
			$statistic['regions'] = TestSettings::getregion($id);

			$regions = array_keys($statistic['regions']);

			foreach ($regions as $region) {
				$model->region = $region;
				$statistic['region'][$region] = count($model->sereachuser());
			}
		}

		return $statistic;
	}
}
