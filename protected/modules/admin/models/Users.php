<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id_user
 * @property string $name_listener
 * @property string $email
 * @property string $date_birth
 * @property integer $sex
 * @property integer $id_education
 * @property string $login
 * @property string $password
 * @property string $date_add
 * @property integer $status
 * @property integer $id_category
 * @property integer $id_radiostation
 * @property string $mix_marker
 * @property integer $P1
 * @property integer $id_card
 * @property integer $mobile_ID
 */
class Users extends CActiveRecord
{
	public $password_repeat;
	public $radiostation;
	public $location;
	public $lang;
	public $_status;
	public $age;
	public $admin_name;
	public $admin_P1;
	public $admin_P2;
	public $admin_region;
	public $test_done;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_listener,date_birth,sex,id_education,P1,email,region', 'required','on'=>'update'),
			array('P1', 'required','on'=>'user'),
			array('email','required','message'=>Yii::t('radio','enter your email'),'on'=>'user'),
			array('sex','required','message'=>Yii::t('radio','enter your sex'),'on'=>'user'),
			array('name_listener','required','message'=>Yii::t('radio','enter your name'),'on'=>'user'),
			array('date_birth','required','message'=>Yii::t('radio','enter your Date Birth'),'on'=>'user'),
			array('id_education','required','message'=>Yii::t('radio','enter your education'),'on'=>'user'),
			array('region','required','message'=>Yii::t('radio','enter your region'),'on'=>'user'),
			array('P2','notP1','on'=>'user'),
			array('login, password,radiostation,email,password_repeat', 'required','on'=>'admin'),
			array('login,password,radiostation,email,location,password_repeat','required','on'=>'noadmin'),
			array('email','email'),
			array('login','unique','on'=>'noadmin,admin '),
			//array('email','unique','on'=>'admin,user'),
			array('password', 'compare','compareAttribute' => 'password_repeat','on'=>'noadmin,admin '),
			array('id_user, sex, id_education, status, id_category, P1, id_card, mobile_ID', 'numerical', 'integerOnly' => true),
			array('name_listener', 'length', 'max' => 255),
			array('email', 'length', 'max' => 100),
			array('login, password', 'length', 'max' => 20,'min'=>6,'on'=>'noadmin,admin '),
			array('mix_marker', 'length', 'max' => 1),
			array('date_birth','date','format'=>'yyyy-mm-dd','on'=>'user'),
			array('date_birth','datestarted','on'=>'user'),
			array('date_birth','datefinished','on'=>'user'),
			array('date_add, lang', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('password_repeat, radiostation,location,link,password,login','safe'),
			array('id_user,lang, name_listener, email, date_birth, sex, id_education, login, password, date_add, status, id_category, radiostation, mix_marker, P1, id_card, mobile_ID,id_radiostation', 'safe', 'on' => 'search'),
		);
	}
	public function notP1($attribute){
		if($this->P1==$this->P2)
			$this->addError($attribute,Yii::t('radio','You already chose this radiostation'));
	}
	public function datestarted($attribute){
		$date=date("Y-m-d");
		$date_last=100*365*60*60*24;
		if($this->date_birth)
			if ($this->date_birth!=='0000-00-00')
				if(strtotime($this->date_birth)< (strtotime($date)-$date_last))
					$this->addError($attribute,Yii::t('radio',"You entered the incorrect date"));
	}
	public function datefinished($attribute){
		$date=date("Y-m-d");
		$date_last=7*365*60*60*24;
		if($this->date_birth)
			if ($this->date_birth!=='0000-00-00')
				if(strtotime($this->date_birth)> (strtotime($date)-$date_last))
					$this->addError($attribute,Yii::t('radio',"You entered the incorrect date"));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'radio' => array(self::BELONGS_TO, 'Radistations', 'id_radiostation'),
			'education'=>array(self::BELONGS_TO,'EducationMult','id_education'),
			'usertest'=>array(self::BELONGS_TO,'Usertest','id_user')

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => Yii::t('radio', 'Id User'),
			'name_listener' => Yii::t('radio', 'Your Name*'),
			'email' => Yii::t('radio', 'Email*'),
			'date_birth' => Yii::t('radio', 'Date Birth*'),
			'sex' => Yii::t('radio', 'Sex*'),
			'id_education' => Yii::t('radio', 'What education do you have?*'),
			'login' => Yii::t('radio', 'Login'),
			'password' => Yii::t('radio', 'Password'),
			'password_repeat' => Yii::t('radio', 'rePassword'),
			'date_add' => Yii::t('radio', 'Date Add'),
			'status' => Yii::t('radio', 'Status'),
			'id_category' => Yii::t('radio', 'Id Category'),
			'id_radiostation' => Yii::t('radio', 'Id Radiostation'),
			'mix_marker' => Yii::t('radio', 'Mix Marker'),
			'P1' => Yii::t('radio', 'What radiostation are you listen more than other on last week?*'),
			'P2' => Yii::t('radio', 'What other radiostations are you listen yet on last week?'),
			'id_card' => Yii::t('radio', 'Id Card'),
			'mobile_ID' => Yii::t('radio', 'Mobile'),
			'region'=>Yii::t('radio','Where are you from?'),
			'age'=>Yii::t('radio','Age'),
			'admin_name'=>Yii::t('radio','Name'),
			'admin_P1'=>Yii::t('radio','P1'),
			'admin_P2'=>Yii::t('radio','P2'),
			'admin_region'=>Yii::t('radio','Region'),
			'test_done'=>Yii::t('radio','tests done'),
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

		$criteria = new CDbCriteria;

		$criteria->with=array('radio','education');
		$criteria->compare('id_user', $this->id_user);
		$criteria->compare('name_listener', $this->name_listener, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('date_birth', $this->date_birth, true);
		$criteria->compare('sex', $this->sex);
		$criteria->compare('t.id_education', $this->id_education);
		$criteria->compare('login', $this->login, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('t.date_add', $this->date_add, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('id_category', $this->id_category);
		$criteria->compare('t.id_radiostation', $this->id_radiostation);
		$criteria->compare('mix_marker', $this->mix_marker, true);
		$criteria->compare('P1', $this->P1);
		$criteria->compare('id_card', $this->id_card);
		$criteria->compare('mobile_ID', $this->mobile_ID);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pagesize' => 50,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password, $this->password);
	}

	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}
	public function getsex(){
		$arr=array(0=>'',1=>Yii::t('radio','Man'),2=>Yii::t('radio','Woman'));
		if(!isset($this->sex))
			return $arr[0];
		return $arr[$this->sex];
	}

	protected function beforeSave()
	{
		if ($this->isNewRecord) {
			if ($this->radiostation == 'admin') {
				$this->id_category = 1;
			} elseif(isset($this->radiostation)) {
				$radio = new Radistations();
				$radio->name = $this->radiostation;
				$radio->date_add = date(" Y-m-d");
				$radio->location = $this->location;
				$radio->id_languege = $this->lang;
				$radio->save();
				$this->date_add= date(" Y-m-d");

				$this->id_radiostation = $radio->id_radiostation;
				$this->id_category = 2;
			}
			else{
				$this->id_category=3;
			}
			$this->date_add= date(" Y-m-d");
		}

		parent::beforeSave();
return true;
	}
	protected function afterSave(){

			if($this->id_category==3 and $this->status!=1 and $this->status!=$this->_status){

				$criteria = new CDbCriteria;
				$criteria->compare('id_radiostation', $this->id_radiostation);
				$criteria->compare('id_status',2);
				$criteria->compare('id_type',1);
				$musictest=MusicTest::model()->find($criteria);
				if($musictest){
					new UsersInvitation($this,$musictest->id_test);
				}
		}
	}
	protected function afterDelete(){
		Usertest::model()->deleteAll("`id_user`={$this->id_user}");
		MusicTestDetail::model()->deleteAll("`id_user`={$this->id_user}");
		parent::afterDelete();
	}
	protected function afterFind()
	{
		parent::afterFind();
		$this->_status=$this->status;
		$this->getage();
	}
	protected function getage(){
		$diff = abs(time()-strtotime($this->date_birth));
		$years = floor($diff / (365*60*60*24));
		$this->age=$years;
	}
	public function getregion(){

	return	$this->radio->testsettings->getregions($this->region);
	}
	public function getcounttest(){
	$i=count($this->usertest);
		return $i;
	}
}
