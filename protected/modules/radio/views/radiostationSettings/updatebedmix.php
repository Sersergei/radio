<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/mini_player.js', CClientScript::POS_HEAD); ?>
<?php
/* @var $this RadiostationSettingsController */
/* @var $model RadiostationSettings */


$this->menu=array(
	array('label'=>'List RadiostationSettings', 'url'=>array('index')),

);
?>

<h1>Update bed mix-marker </h1>

<?php $this->renderPartial('_form1', array('model'=>$model)); ?>