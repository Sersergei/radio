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
			array('id_user, login, password', 'required'),
			array('id_user, sex, id_education, status, id_category, id_radiostation, P1, id_card, mobile_ID', 'numerical', 'integerOnly'=>true),
			array('name_listener', 'length', 'max'=>255),
			array('email', 'length', 'max'=>100),
			array('login, password', 'length', 'max'=>20),
			array('mix_marker', 'length', 'max'=>1),
			array('date_birth, date_add', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, name_listener, email, date_birth, sex, id_education, login, password, date_add, status, id_category, id_radiostation, mix_marker, P1, id_card, mobile_ID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'name_listener' => 'Name Listener',
			'email' => 'Email',
			'date_birth' => 'Date Birth',
			'sex' => 'Sex',
			'id_education' => 'Id Education',
			'login' => 'Login',
			'password' => 'Password',
			'date_add' => 'Date Add',
			'status' => 'Status',
			'id_category' => 'Id Category',
			'id_radiostation' => 'Id Radiostation',
			'mix_marker' => 'Mix Marker',
			'P1' => 'P1',
			'id_card' => 'Id Card',
			'mobile_ID' => 'Mobile',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('name_listener',$this->name_listener,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('date_birth',$this->date_birth,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('id_education',$this->id_education);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('date_add',$this->date_add,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_radiostation',$this->id_radiostation);
		$criteria->compare('mix_marker',$this->mix_marker,true);
		$criteria->compare('P1',$this->P1);
		$criteria->compare('id_card',$this->id_card);
		$criteria->compare('mobile_ID',$this->mobile_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}
}
