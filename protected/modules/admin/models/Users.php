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
			array('name_listener,date_birth,sex,id_education,P1,P2,email', 'required','on'=>'user'),
			array('login, password,radiostation,email,password_repeat', 'required','on'=>'admin'),
			array('login,password,radiostation,email,location,password_repeat','required','on'=>'noadmin'),
			array('email','email'),
			array('password', 'compare'),
			array('id_user, sex, id_education, status, id_category, P1, id_card, mobile_ID', 'numerical', 'integerOnly' => true),
			array('name_listener', 'length', 'max' => 255),
			array('email', 'length', 'max' => 100),
			array('login, password', 'length', 'max' => 20),
			array('mix_marker', 'length', 'max' => 1),
			array('date_birth, date_add', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, name_listener, email, date_birth, sex, id_education, login, password, date_add, status, id_category, radiostation, mix_marker, P1, id_card, mobile_ID', 'safe', 'on' => 'search'),
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
			'radio' => array(self::BELONGS_TO, 'Radistations', 'id_radiostation'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => Yii::t('radio', 'Id User'),
			'name_listener' => Yii::t('radio', 'Name Listener'),
			'email' => Yii::t('radio', 'Email'),
			'date_birth' => Yii::t('radio', 'Date Birth'),
			'sex' => Yii::t('radio', 'Sex'),
			'id_education' => Yii::t('radio', 'Id Education'),
			'login' => Yii::t('radio', 'Login'),
			'password' => Yii::t('radio', 'Password'),
			'password_repeat' => Yii::t('radio', 'rePassword'),
			'date_add' => Yii::t('radio', 'Date Add'),
			'status' => Yii::t('radio', 'Status'),
			'id_category' => Yii::t('radio', 'Id Category'),
			'id_radiostation' => Yii::t('radio', 'Id Radiostation'),
			'mix_marker' => Yii::t('radio', 'Mix Marker'),
			'P1' => Yii::t('radio', 'P1'),
			'id_card' => Yii::t('radio', 'Id Card'),
			'mobile_ID' => Yii::t('radio', 'Mobile'),
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

		$criteria->with=array('radio');
		$criteria->compare('id_user', $this->id_user);
		$criteria->compare('name_listener', $this->name_listener, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('date_birth', $this->date_birth, true);
		$criteria->compare('sex', $this->sex);
		$criteria->compare('id_education', $this->id_education);
		$criteria->compare('login', $this->login, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('date_add', $this->date_add, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('id_category', $this->id_category);
		$criteria->compare('radio.id_radiostation', $this->id_radiostation);
		$criteria->compare('mix_marker', $this->mix_marker, true);
		$criteria->compare('P1', $this->P1);
		$criteria->compare('id_card', $this->id_card);
		$criteria->compare('mobile_ID', $this->mobile_ID);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
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

	protected function beforeSave()
	{
		if ($this->isNewRecord)
			if($this->radiostation=='admin'){
				$this->id_category=1;
			}
		else {
			$radio = new Radistations();
			$radio->name = $this->radiostation;
			$radio->date_add = date(" Y-m-d");
			$radio->location=$this->location;
			$radio->id_languege=$this->lang;
			$radio->save();
			$radio->date_add = date(" Y-m-d");
			$this->id_radiostation = $radio->id_radiostation;
			$this->id_category=2;
		}
		parent::beforeSave();
return true;
	}
}
