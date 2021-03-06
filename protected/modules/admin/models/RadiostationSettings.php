<?php

/**
 * This is the model class for table "radiostation_settings".
 *
 * The followings are the available columns in table 'radiostation_settings':
 * @property integer $id_radio_settings
 * @property integer $id_lang
 * @property integer $id_user
 * @property string $test_song
 * @property integer $not_use_music_marker
 * @property integer $not_register_users
 * @property integer $not_invite_users
 * @property integer $mix_marker_1
 * @property integer $mix_marker_2
 * @property integer $mix_marker_3
 * @property integer $mix_marker_4
 * @property string $mix_marker
 * @property integer $id_radiostation
 * @property string $other_radiostations
 * @property integer $id_card_registration
 *
 * The followings are the available model relations:
 * @property Lang $idLang
 * @property Users $idUser
 * @property Radistations $idRadiostation
 */
class RadiostationSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $mixmarker;
	public function tableName()
	{
		return 'radiostation_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lang,other_radiostations,email', 'required'),
			array('id_lang, id_user, not_use_music_marker, not_register_users, not_invite_users, id_radiostation, id_card_registration', 'numerical', 'integerOnly'=>true),
			array('other_radiostations', 'length', 'max'=>1000),
			array('email','email'),
			array('test_song, mix_marker,never_test', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_radio_settings, id_lang, id_user, test_song, not_use_music_marker, not_register_users, not_invite_users, mix_marker, id_radiostation, other_radiostations, id_card_registration', 'safe', 'on'=>'search'),
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
			'idLang' => array(self::BELONGS_TO, 'Lang', 'id_lang'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
			'Radiostation' => array(self::BELONGS_TO, 'Radistations', 'id_radiostation'),
			'mix' => array(self::BELONGS_TO, 'Mixmarker', 'mix_marker'),
			'testsetings' => array(self::HAS_ONE, 'TestSettings', 'id_radiostation'),
			'testsetingsmult' => array(self::HAS_ONE, 'TestSettingsMult', 'id_radiostations'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_radio_settings' => Yii::t('radio', 'Id Radio Settings'),
			'id_lang' => Yii::t('radio', 'Language'),
			'id_user' => Yii::t('radio', 'Id User'),
			'test_song' => Yii::t('radio', 'Test Song'),
			'not_use_music_marker' => Yii::t('radio', 'Not use music-marker'),
			'not_register_users' => Yii::t('radio', 'Not register if user doesn\'t choosed right music-maker'),
			'not_invite_users' => Yii::t('radio', 'Not invite for music test if user doesn\'t choosed right music-maker'),
			'bed_mixmarker' => Yii::t('radio', 'Mix Marker Bed'),
			'god_mixmarker' => Yii::t('radio', 'Mix Marker Good'),
			'mix_marker' => Yii::t('radio', 'Mix Marker') ,
			'id_radiostation' => Yii::t('radio', 'Id Radiostation'),
			'other_radiostations' => Yii::t('radio', 'Other Radiostations') ,
			'id_card_registration' => Yii::t('radio', 'Necessity ID card for registration') ,
			'email'=>Yii::t('radio','Your mail for subscribe'),
			'never_test'=>Yii::t('radio','unknown (without of next question)'),
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

		$criteria->with=array('Radiostation','idLang','mix','testsetings','testsetingsmult'); // жадная загрузка
		$criteria->compare('id_radio_settings',$this->id_radio_settings);
		$criteria->compare('idLang.id_lang',$this->id_lang);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('test_song',$this->test_song,true);
		$criteria->compare('not_use_music_marker',$this->not_use_music_marker);
		$criteria->compare('not_register_users',$this->not_register_users);
		$criteria->compare('not_invite_users',$this->not_invite_users);
		$criteria->compare('bed_mixmarker',$this->bed_mixmarker);
		$criteria->compare('god_mixmarker',$this->god_mixmarker);
		$criteria->compare('mix.mix_marker',$this->mix_marker,true);
		$criteria->compare('Radiostation.id_radiostation',$this->id_radiostation);
		$criteria->compare('other_radiostations',$this->other_radiostations,true);
		$criteria->compare('id_card_registration',$this->id_card_registration);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RadiostationSettings the static model class
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

		}
		parent::beforeSave();
		return true;
	}
	public function getnot_use_music_marker(){
		$arr=array('No','Yes');
		return $arr[$this->not_use_music_marker];
	}
	public function getnever_test(){
		$arr=array('No','Yes');
		return $arr[$this->never_test];
	}
	public function getnot_register_users(){
	$arr=array('No','Yes');
	return $arr[$this->not_register_users];
	}
	public function getnot_invite_users(){
		$arr=array('No','Yes');
		return $arr[$this->not_invite_users];
	}
	public function getid_card_registration(){

		$arr=array('No','Yes');
		return $arr[$this->id_card_registration];
	}
	public function getMixmarker(){

		$mix=Mixmarker::model()->findByPk($this->mix_marker);

		if($mix){
			$name=explode(".",$mix->name);
			$name=$name[0];
			$i=preg_replace("/[0-9]/","", $name);
			return "<div class='lm-inner clearfix'>
<spain>".$i."</spain>
         <div class='mini_controls'>
                <a href='javascript:void(0)' class='mini-play' style='display:block ;' onclick=\"var x= document.getElementById('player_".$mix->id."'); play(x);\"></a>
                <a href='javascript:void(0)' class='mini-pause' style='display:none ;' onclick=\"document.getElementById('player_".$mix->id."').pause()\"></a>
            </div>
        <div class='lm-track lmtr-top'>
            <audio id='player_".$mix->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $mix->name." ></audio>
</div>
</div>";
		}

	}
	public function getbedmixmarker(){
		$arr=unserialize($this->bed_mixmarker);
		if($arr) {
			$content = "";
			foreach ($arr as $mix) {
				$mix = Mixmarker::model()->findByPk($mix);
				if($mix){
				$name=explode(".",$mix->name);
				$name=$name[0];
				$i=preg_replace("/[0-9]/","", $name);
				$content = $content . "<div class='lm-inner clearfix'>
				<spain>".$i ."</spain>
         <div class='mini_controls'>
                <a href='javascript:void(0)' class='mini-play' style='display:block ;' onclick=\"var x= document.getElementById('player_".$mix->id."'); play(x);\"></a>
                <a href='javascript:void(0)' class='mini-pause' style='display:none ;' onclick=\"document.getElementById('player_".$mix->id."').pause()\"></a>
            </div>
        <div class='lm-track lmtr-top'>
            <audio id='player_".$mix->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $mix->name." ></audio>
</div>
</div>";}
			}
			return $content;
		}
	}
	public function getgodmixmarker(){

		$arr=unserialize($this->god_mixmarker);
		if($arr){
			$content="";
			foreach($arr as $mix){
				$mix=Mixmarker::model()->findByPk($mix);
				if($mix){
				$name=explode(".",$mix->name);
				$name=$name[0];
				$i=preg_replace("/[0-9]/","", $name);
				$content=$content."<div class='lm-inner clearfix'>
				<spain>".$i."</spain>
         <div class='mini_controls'>
                <a href='javascript:void(0)' class='mini-play' style='display:block ;' onclick=\"var x= document.getElementById('player_".$mix->id."'); play(x);\"></a>
                <a href='javascript:void(0)' class='mini-pause' style='display:none ;' onclick=\"document.getElementById('player_".$mix->id."').pause()\"></a>
            </div>
        <div class='lm-track lmtr-top'>
            <audio id='player_".$mix->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $mix->name." ></audio>
</div>
</div>";}
			}
			return $content;
		}

	}
	public static function getradiostation($id){
		$criteria=new CDbCriteria;
		$criteria->compare('id_radiostation',$id);
		$settings=RadiostationSettings::model()->find($criteria);
		if($settings->other_radiostations){
			$arr=explode(",",$settings->other_radiostations);
		}

		$arr[$id]=$settings->Radiostation->name;

		return $arr;

	}
	public function getradio($id=Null){
		if($id===Null)
			return null;
		$arr=explode(",",$this->other_radiostations);
		$arr[$this->id_radiostation]=$this->Radiostation->name;
		return $arr[$id];
	}
	public function gettestsongs(){
		if($this->mix_marker)
			$r=$this->mix_marker;//песня для тестирования музыки
		else{
			$r=unserialize($this->god_mixmarker);
			$r=$r[0];
		}
		return $r;
	}

}
