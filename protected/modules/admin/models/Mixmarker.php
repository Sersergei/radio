<?php

/**
 * This is the model class for table "mixmarker".
 *
 * The followings are the available columns in table 'mixmarker':
 * @property integer $id
 * @property string $name
 */
class Mixmarker extends CActiveRecord
{
	public $id_radiostation;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mixmarker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>200),
			array('id_radiostation','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'radiostation' => array(self::HAS_MANY, 'RadiotationSettings', 'mix_marker'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mixmarker the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function all(){
		$criteria=new CDbCriteria;
		$criteria->addCondition('id_radiostation IS NULL');
		$models=self::model()->findAll($criteria);
		$array=array();

		foreach($models as $miksmarker){
			$name=explode(".",$miksmarker->name);
			$name=$name[0];
			$i=preg_replace("/[0-9]/","", $name);
			$array[$miksmarker->id] ="<div class='lm-inner'>
			<spain>".$i."</spain>
         <div class='mini_controls'>
                <a href='javascript:void(0)' class='mini-play' style='display:block ;' onclick=\"var x= document.getElementById('player_".$miksmarker->id."'); play(x);\"></a>
                <a href='javascript:void(0)' class='mini-pause' style='display:none ;' onclick=\"document.getElementById('player_".$miksmarker->id."').pause()\"></a>
            </div>
        <div class='lm-track lmtr-top'>
            <audio id='player_".$miksmarker->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $miksmarker->name." ></audio>
</div>
</div>";
		}
		return $array;
	}
}
/*
$arr="<div class='lm-inner clearfix'>
        <div class='mini_controls'>

        </div>

         <div class='mini_controls'>
                <a href='javascript:void(0)' class='mini-play' style='display: block;' onclick='document.getElementById('player_".$miksmarker->id."').play()'></a>
                <a href='javascript:void(0)' class='mini-pause ' style='display: none;' onclick='document.getElementById('player_".$miksmarker->id."').pause()'></a>
            </div>
        <div class='lm-track lmtr-top'>
            <audio id='player_".$miksmarker->id."' class='track_player' src=".Yii::app()->getBaseUrl(true)."/mixmarker/". $miksmarker->name." ></audio>
</div>
</div>";


$array[$miksmarker->id] ='<audio src='.Yii::app()->getBaseUrl(true).'/mixmarker/'. $miksmarker->name . ' controls></audio></br>
			<spain>'.$i.'</spain>';
*/