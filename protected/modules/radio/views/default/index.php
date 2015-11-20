<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>Страница управления музыкальными тестами</h1>
<p>Ссылка на приглашение слушателей пройти регистрацию:</p>
<?php
$user=Users::model()->find('id_user=:user', array(':user'=>Yii::app()->user->id));
//$model=RadiostationSettings::model()->find('id_radiostation=:id', array(':id'=>$user->id_radiostation));
echo Yii::app()->getBaseUrl(true)."/register/".$user->id_radiostation; ?>

<p>
